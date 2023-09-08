(window.yoastWebpackJsonp=window.yoastWebpackJsonp||[]).push([[15],{1:function(e,t,n){e.exports=n(22)()},18:function(e,t){e.exports=window.yoast.styleGuide},22:function(e,t,n){"use strict";var r=n(23),i=n(24),o=n(25);e.exports=function(){function e(e,t,n,r,s,a){a!==o&&i(!1,"Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types")}function t(){return e}e.isRequired=e;var n={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t};return n.checkPropTypes=r,n.PropTypes=n,n}},23:function(e,t,n){"use strict";function r(e){return function(){return e}}var i=function(){};i.thatReturns=r,i.thatReturnsFalse=r(!1),i.thatReturnsTrue=r(!0),i.thatReturnsNull=r(null),i.thatReturnsThis=function(){return this},i.thatReturnsArgument=function(e){return e},e.exports=i},24:function(e,t,n){"use strict";var r=function(e){};e.exports=function(e,t,n,i,o,s,a,u){if(r(t),!e){var c;if(void 0===t)c=new Error("Minified exception occurred; use the non-minified dev environment for the full error message and additional helpful warnings.");else{var d=[n,i,o,s,a,u],p=0;(c=new Error(t.replace(/%s/g,function(){return d[p++]}))).name="Invariant Violation"}throw c.framesToPop=1,c}}},25:function(e,t,n){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"},3:function(e,t){e.exports=window.wp.i18n},4:function(e,t){e.exports=window.wp.element},5:function(e,t){e.exports=window.yoast.componentsNew},539:function(e,t,n){"use strict";var r=n(4),i=function(e){return e&&e.__esModule?e:{default:e}}(n(540));var o={},s={};window.yoast=window.yoast||{},window.yoast.indexing=window.yoast.indexing||{};var a=void 0;function u(){a||(a=document.getElementById("yoast-seo-indexing-action")),a&&(0,r.render)(wp.element.createElement(i.default,{preIndexingActions:o,indexingActions:s}),a)}window.yoast.indexing.registerPreIndexingAction=function(e,t){o[e]=t,u()},window.yoast.indexing.registerIndexingAction=function(e,t){s[e]=t,u()},window.yoast.indexation=window.yoast.indexing,window.yoast.indexation.registerPreIndexationAction=function(e,t){console.warn("Deprecated since 15.1. Use 'window.yoast.indexing.registerPreIndexingAction' instead."),window.yoast.indexing.registerPreIndexingAction(e,t)},window.yoast.indexation.registerIndexationAction=function(e,t){console.warn("Deprecated since 15.1. Use 'window.yoast.indexing.registerIndexingAction' instead."),window.yoast.indexing.registerIndexingAction(e,t)},jQuery(function(){u()})},540:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.Indexation=void 0;var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),i=n(4),o=n(3),s=n(5),a=n(18),u=function(e){return e&&e.__esModule?e:{default:e}}(n(1)),c=n(541);function d(e){return function(){var t=e.apply(this,arguments);return new Promise(function(e,n){return function r(i,o){try{var s=t[i](o),a=s.value}catch(e){return void n(e)}if(!s.done)return Promise.resolve(a).then(function(e){r("next",e)},function(e){r("throw",e)});e(a)}("next")})}}var p={IDLE:"idle",IN_PROGRESS:"in_progress",ERRORED:"errored",COMPLETED:"completed"},l=t.Indexation=function(e){function t(e){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var n=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));return n.settings=yoastIndexingData,n.state={state:p.IDLE,processed:0,amount:parseInt(n.settings.amount,10),firstTime:"1"===n.settings.firstTime},n.startIndexing=n.startIndexing.bind(n),n.stopIndexing=n.stopIndexing.bind(n),n}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,i.Component),r(t,[{key:"doIndexingRequest",value:function(){var e=d(regeneratorRuntime.mark(function e(t,n){var r,i;return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,fetch(t,{method:"POST",headers:{"X-WP-Nonce":n}});case 2:return r=e.sent,e.next=5,r.json();case 5:if(i=e.sent,r.ok){e.next=8;break}throw new Error(i.message);case 8:return e.abrupt("return",i);case 9:case"end":return e.stop()}},e,this)}));return function(t,n){return e.apply(this,arguments)}}()},{key:"doPreIndexingAction",value:function(){var e=d(regeneratorRuntime.mark(function e(t){return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:if("function"!=typeof this.props.preIndexingActions[t]){e.next=3;break}return e.next=3,this.props.preIndexingActions[t](this.settings);case 3:case"end":return e.stop()}},e,this)}));return function(t){return e.apply(this,arguments)}}()},{key:"doPostIndexingAction",value:function(){var e=d(regeneratorRuntime.mark(function e(t,n){return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:if("function"!=typeof this.props.indexingActions[t]){e.next=3;break}return e.next=3,this.props.indexingActions[t](n.objects,this.settings);case 3:case"end":return e.stop()}},e,this)}));return function(t,n){return e.apply(this,arguments)}}()},{key:"doIndexing",value:function(){var e=d(regeneratorRuntime.mark(function e(t){var n,r=this;return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:n=this.settings.restApi.root+this.settings.restApi.endpoints[t];case 1:if(!this.isState(p.IN_PROGRESS)||!1===n){e.next=11;break}return e.prev=2,e.delegateYield(regeneratorRuntime.mark(function e(){var i;return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,r.doPreIndexingAction(t);case 2:return e.next=4,r.doIndexingRequest(n,r.settings.restApi.nonce);case 4:return i=e.sent,e.next=7,r.doPostIndexingAction(t,i);case 7:r.setState(function(e){return{processed:e.processed+i.objects.length,firstTime:!1}}),n=i.next_url;case 9:case"end":return e.stop()}},e,r)})(),"t0",4);case 4:e.next=9;break;case 6:e.prev=6,e.t1=e.catch(2),this.setState({state:p.ERRORED,firstTime:!1});case 9:e.next=1;break;case 11:case"end":return e.stop()}},e,this,[[2,6]])}));return function(t){return e.apply(this,arguments)}}()},{key:"index",value:function(){var e=d(regeneratorRuntime.mark(function e(){var t,n,r,i,o,s;return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:t=!0,n=!1,r=void 0,e.prev=3,i=Object.keys(this.settings.restApi.endpoints)[Symbol.iterator]();case 5:if(t=(o=i.next()).done){e.next=12;break}return s=o.value,e.next=9,this.doIndexing(s);case 9:t=!0,e.next=5;break;case 12:e.next=18;break;case 14:e.prev=14,e.t0=e.catch(3),n=!0,r=e.t0;case 18:e.prev=18,e.prev=19,!t&&i.return&&i.return();case 21:if(e.prev=21,!n){e.next=24;break}throw r;case 24:return e.finish(21);case 25:return e.finish(18);case 26:this.isState(p.ERRORED)||this.isState(p.IDLE)||this.completeIndexing();case 27:case"end":return e.stop()}},e,this,[[3,14,18,26],[19,,21,25]])}));return function(){return e.apply(this,arguments)}}()},{key:"startIndexing",value:function(){var e=d(regeneratorRuntime.mark(function e(){return regeneratorRuntime.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:this.setState({processed:0,state:p.IN_PROGRESS},this.index);case 1:case"end":return e.stop()}},e,this)}));return function(){return e.apply(this,arguments)}}()},{key:"completeIndexing",value:function(){this.setState({state:p.COMPLETED})}},{key:"stopIndexing",value:function(){this.setState(function(e){return{state:p.IDLE,processed:0,amount:e.amount-e.processed}})}},{key:"componentDidMount",value:function(){if(!this.settings.disabled&&"true"===new URLSearchParams(window.location.search).get("start-indexation")){var e=(0,c.removeSearchParam)(window.location.href,"start-indexation");(0,c.addHistoryState)(null,document.title,e),this.startIndexing()}}},{key:"isState",value:function(e){return this.state.state===e}},{key:"renderFirstIndexationNotice",value:function(){return wp.element.createElement(s.Alert,{type:"info"},(0,o.__)("This feature includes and replaces the Text Link Counter and Internal Linking Analysis","wordpress-seo"))}},{key:"renderStartButton",value:function(){return wp.element.createElement(s.NewButton,{variant:"primary",onClick:this.startIndexing},(0,o.__)("Start SEO data optimization","wordpress-seo"))}},{key:"renderStopButton",value:function(){return wp.element.createElement(s.NewButton,{variant:"secondary",onClick:this.stopIndexing},(0,o.__)("Stop SEO data optimization","wordpress-seo"))}},{key:"renderDisabledTool",value:function(){return wp.element.createElement(i.Fragment,null,wp.element.createElement("p",null,wp.element.createElement(s.NewButton,{variant:"secondary",disabled:!0},(0,o.__)("Start SEO data optimization","wordpress-seo"))),wp.element.createElement(s.Alert,{type:"info"},(0,o.__)("SEO data optimization is disabled for non-production environments.","wordpress-seo")))}},{key:"renderProgressBar",value:function(){return wp.element.createElement(i.Fragment,null,wp.element.createElement(s.ProgressBar,{style:{height:"16px",margin:"8px 0"},progressColor:a.colors.$color_pink_dark,max:parseInt(this.state.amount,10),value:this.state.processed}),wp.element.createElement("p",{style:{color:a.colors.$palette_grey_text}},(0,o.__)("Optimizing SEO data... This may take a while.","wordpress-seo")))}},{key:"renderErrorAlert",value:function(){return wp.element.createElement(s.Alert,{type:"error"},(0,o.__)("Oops, something has gone wrong and we couldn't complete the optimization of your SEO data. Please click the button again to re-start the process.","wordpress-seo"))}},{key:"renderTool",value:function(){return wp.element.createElement(i.Fragment,null,this.isState(p.IN_PROGRESS)&&this.renderProgressBar(),this.isState(p.ERRORED)&&this.renderErrorAlert(),this.isState(p.IDLE)&&this.state.firstTime&&this.renderFirstIndexationNotice(),this.isState(p.IN_PROGRESS)?this.renderStopButton():this.renderStartButton())}},{key:"render",value:function(){return this.settings.disabled?this.renderDisabledTool():this.isState(p.COMPLETED)||0===this.state.amount?wp.element.createElement(s.Alert,{type:"success"},(0,o.__)("SEO data optimization complete","wordpress-seo")):this.renderTool()}}]),t}();l.propTypes={indexingActions:u.default.object,preIndexingActions:u.default.object},l.defaultProps={indexingActions:{},preIndexingActions:{}},t.default=l},541:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.removeSearchParam=function(e,t){var n=new URL(e);return n.searchParams.delete(t),n.href},t.addHistoryState=function(e,t,n){window.history.pushState(e,t,n)}}},[[539,0]]]);