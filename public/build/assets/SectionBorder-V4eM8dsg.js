import{d}from"./SecondaryButton-COuI1enB.js";import{o as l,c as n,w as i,a as e,E as a,d as m}from"./app-Cta_gWxB.js";import{_}from"./_plugin-vue_export-helper-DlAUqK2U.js";const f={class:"px-6 py-4"},x={class:"text-lg font-medium text-gray-900"},h={class:"mt-4 text-sm text-gray-600"},p={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-end"},$={__name:"DialogModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(t,{emit:s}){const c=s,r=()=>{c("close")};return(o,b)=>(l(),n(d,{show:t.show,"max-width":t.maxWidth,closeable:t.closeable,onClose:r},{default:i(()=>[e("div",f,[e("div",x,[a(o.$slots,"title")]),e("div",h,[a(o.$slots,"content")])]),e("div",p,[a(o.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}},u={},y={class:"hidden sm:block"};function w(t,s){return l(),m("div",y,s[0]||(s[0]=[e("div",{class:"py-8"},[e("div",{class:"border-t border-gray-200"})],-1)]))}const k=_(u,[["render",w]]);export{k as S,$ as _};