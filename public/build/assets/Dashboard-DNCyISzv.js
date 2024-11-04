import{_ as m}from"./AppLayout-mOvPgsmj.js";import{_ as g}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{j as h,h as v,c as p,w as l,o as a,a as t,t as r,d as i,g as d,F as n}from"./app-QC31J3KV.js";const x=h({components:{AppLayout:m},props:{stats:Object,latest_articles:Array,latest_topics:Array}}),u={class:"py-12"},_={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},f={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg"},w={class:"bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8"},y={class:"p-6 bg-white rounded-lg shadow-md"},b={class:"ml-12"},k={class:"mt-2 text-sm text-gray-500"},C={class:"p-6 bg-white rounded-lg shadow-md"},M={class:"ml-12"},A={class:"mt-2 text-sm text-gray-500"},B={class:"p-6 bg-white rounded-lg shadow-md"},L={class:"ml-12"},j={class:"mt-2 text-sm text-gray-500"},H={class:"p-6 border-t border-gray-200 md:border-t-0 md:border-l"},z={class:"ml-12"},T={class:"mt-2 space-y-4"},V=["href"],$=["href"],D={class:"p-6 border-t border-gray-200"},F={class:"ml-12"},S={class:"mt-2 space-y-4"},E=["href"];function N(e,s,O,W,q,G){const c=v("AppLayout");return a(),p(c,{title:"Dashboard"},{header:l(()=>s[0]||(s[0]=[t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Admin Dashboard ",-1)])),default:l(()=>[t("div",u,[t("div",_,[t("div",f,[s[7]||(s[7]=t("div",{class:"p-6 sm:px-20 bg-white border-b border-gray-200"},[t("div",{class:"mt-8 text-2xl"}," Welcome to your admin dashboard! "),t("div",{class:"mt-6 text-gray-500"}," Here's an overview of your site's activity. ")],-1)),t("div",w,[t("div",y,[s[1]||(s[1]=t("div",{class:"flex items-center"},[t("svg",{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",class:"w-8 h-8 text-gray-400"},[t("path",{d:"M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"})]),t("div",{class:"ml-4 text-lg text-gray-600 leading-7 font-semibold"},"Total Members")],-1)),t("div",b,[t("div",k,r(e.stats.total_users),1)])]),t("div",C,[s[2]||(s[2]=t("div",{class:"flex items-center"},[t("svg",{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",class:"w-8 h-8 text-gray-400"},[t("path",{d:"M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"}),t("path",{d:"M15 13a3 3 0 11-6 0 3 3 0 016 0z"})]),t("div",{class:"ml-4 text-lg text-gray-600 leading-7 font-semibold"},"Total Articles")],-1)),t("div",M,[t("div",A,r(e.stats.total_articles),1)])]),t("div",B,[s[3]||(s[3]=t("div",{class:"flex items-center"},[t("svg",{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",class:"w-8 h-8 text-gray-400"},[t("path",{d:"M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"})]),t("div",{class:"ml-4 text-lg text-gray-600 leading-7 font-semibold"},"Total Forum Topics")],-1)),t("div",L,[t("div",j,r(e.stats.total_topics),1)])])]),t("div",H,[s[5]||(s[5]=t("div",{class:"flex items-center"},[t("svg",{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",class:"w-8 h-8 text-gray-400"},[t("path",{d:"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"})]),t("div",{class:"ml-4 text-lg text-gray-600 leading-7 font-semibold"},"Latest A")],-1)),t("div",z,[t("div",T,[(a(!0),i(n,null,d(e.latest_articles,o=>(a(),i("div",{key:o.id,class:"text-sm flex items-center justify-between"},[t("a",{href:e.route("article",o.id),class:"text-indigo-600 hover:text-indigo-900",target:"_blank"},r(o.title),9,V),t("a",{href:e.route("admin.articles.edit",o.id),class:"text-gray-400 hover:text-gray-600"},s[4]||(s[4]=[t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"})],-1)]),8,$)]))),128))])])]),t("div",D,[s[6]||(s[6]=t("div",{class:"flex items-center"},[t("svg",{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",class:"w-8 h-8 text-gray-400"},[t("path",{d:"M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"})]),t("div",{class:"ml-4 text-lg text-gray-600 leading-7 font-semibold"},"Latest Forum Topics")],-1)),t("div",F,[t("div",S,[(a(!0),i(n,null,d(e.latest_topics,o=>(a(),i("div",{key:o.id,class:"text-sm"},[t("a",{href:e.route("member.forum.topic",o.id),class:"text-indigo-600 hover:text-indigo-900",target:"_blank"},r(o.title),9,E)]))),128))])])])])])])]),_:1})}const P=g(x,[["render",N]]);export{P as default};