import{b as u,I as S,r as h,T as z,h as c,c as v,w as d,o as i,a as l,d as f,F as D,g as I,u as p,t as m,f as O,e as H,Y as N}from"./app-Cta_gWxB.js";import{_ as C}from"./_plugin-vue_export-helper-DlAUqK2U.js";var F={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M928 140H96c-17.7 0-32 14.3-32 32v496c0 17.7 14.3 32 32 32h380v112H304c-8.8 0-16 7.2-16 16v48c0 4.4 3.6 8 8 8h432c4.4 0 8-3.6 8-8v-48c0-8.8-7.2-16-16-16H548V700h380c17.7 0 32-14.3 32-32V172c0-17.7-14.3-32-32-32zm-40 488H136V212h752v416z"}}]},name:"desktop",theme:"outlined"};function x(o){for(var e=1;e<arguments.length;e++){var t=arguments[e]!=null?Object(arguments[e]):{},s=Object.keys(t);typeof Object.getOwnPropertySymbols=="function"&&(s=s.concat(Object.getOwnPropertySymbols(t).filter(function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),s.forEach(function(a){E(o,a,t[a])})}return o}function E(o,e,t){return e in o?Object.defineProperty(o,e,{value:t,enumerable:!0,configurable:!0,writable:!0}):o[e]=t,o}var g=function(e,t){var s=x({},e,t.attrs);return u(S,x({},s,{icon:F}),null)};g.displayName="DesktopOutlined";g.inheritAttrs=!1;var T={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M744 62H280c-35.3 0-64 28.7-64 64v768c0 35.3 28.7 64 64 64h464c35.3 0 64-28.7 64-64V126c0-35.3-28.7-64-64-64zm-8 824H288V134h448v752zM472 784a40 40 0 1080 0 40 40 0 10-80 0z"}}]},name:"mobile",theme:"outlined"};function k(o){for(var e=1;e<arguments.length;e++){var t=arguments[e]!=null?Object(arguments[e]):{},s=Object.keys(t);typeof Object.getOwnPropertySymbols=="function"&&(s=s.concat(Object.getOwnPropertySymbols(t).filter(function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),s.forEach(function(a){U(o,a,t[a])})}return o}function U(o,e,t){return e in o?Object.defineProperty(o,e,{value:t,enumerable:!0,configurable:!0,writable:!0}):o[e]=t,o}var _=function(e,t){var s=k({},e,t.attrs);return u(S,k({},s,{icon:T}),null)};_.displayName="MobileOutlined";_.inheritAttrs=!1;const $={key:0,class:"mt-5 space-y-6"},A={class:"text-2xl"},Y={class:"ml-3"},q={class:"text-sm text-gray-600"},G={class:"text-xs text-gray-500"},J={key:0,class:"text-green-500 font-semibold"},Q={key:1},R={class:"flex items-center mt-5"},W={__name:"LogoutOtherBrowserSessionsForm",props:{sessions:Array},setup(o){const e=h(!1),t=h(null),s=z({password:""}),a=()=>{e.value=!0,setTimeout(()=>{t.value.focus()},250)},y=()=>{s.delete(route("other-browser-sessions.destroy"),{preserveScroll:!0,onSuccess:()=>b(),onError:()=>t.value.focus(),onFinish:()=>s.reset()})},b=()=>{e.value=!1,s.reset()};return(X,r)=>{const w=c("a-col"),B=c("a-button"),P=c("a-input-password"),M=c("a-form-item"),V=c("a-modal"),j=c("a-row");return i(),v(j,{gutter:16},{default:d(()=>[u(w,{span:12},{default:d(()=>r[2]||(r[2]=[l("h3",{class:"text-lg font-medium text-gray-900"},"Browser Sessions",-1),l("p",{class:"mt-1 text-sm text-gray-600"}," Manage and log out your active sessions on other browsers and devices. ",-1)])),_:1}),u(w,{span:12},{default:d(()=>[r[5]||(r[5]=l("div",{class:"max-w-xl text-sm text-gray-600"}," If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password. ",-1)),o.sessions.length>0?(i(),f("div",$,[(i(!0),f(D,null,I(o.sessions,(n,L)=>(i(),f("div",{key:L,class:"flex items-center"},[l("div",A,[n.agent.is_desktop?(i(),v(p(g),{key:0,style:{fontSize:"24px"}})):(i(),v(p(_),{key:1,style:{fontSize:"24px"}}))]),l("div",Y,[l("div",q,m(n.agent.platform?n.agent.platform:"Unknown")+" - "+m(n.agent.browser?n.agent.browser:"Unknown"),1),l("div",null,[l("div",G,[O(m(n.ip_address)+", ",1),n.is_current_device?(i(),f("span",J,"This device")):(i(),f("span",Q,"Last active "+m(n.last_active),1))])])])]))),128))])):H("",!0),l("div",R,[u(B,{type:"primary",onClick:a},{default:d(()=>r[3]||(r[3]=[O(" Log Out Other Browser Sessions ")])),_:1})]),u(V,{visible:e.value,"onUpdate:visible":r[1]||(r[1]=n=>e.value=n),title:"Log Out Other Browser Sessions",onOk:y,onCancel:b,okButtonProps:{loading:p(s).processing}},{default:d(()=>[r[4]||(r[4]=l("p",null," Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices. ",-1)),u(M,{class:"mt-4"},{default:d(()=>[u(P,{ref_key:"passwordInput",ref:t,value:p(s).password,"onUpdate:value":r[0]||(r[0]=n=>p(s).password=n),placeholder:"Password",onKeyup:N(y,["enter"])},null,8,["value"])]),_:1})]),_:1},8,["visible","okButtonProps"])]),_:1})]),_:1})}}},ee=C(W,[["__scopeId","data-v-a66905ff"]]);export{ee as default};