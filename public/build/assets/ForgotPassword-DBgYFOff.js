import{T as d,d as i,b as s,u as t,w as l,F as c,o as m,Z as f,a as o,t as p,e as _,n as w,f as g,y}from"./app-Cta_gWxB.js";import{A as b}from"./AuthenticationCard-BHnc9JMM.js";import{_ as x}from"./AuthenticationCardLogo-DtS0aK7h.js";import{_ as k,a as V,b as v}from"./TextInput-HEqLq9Ue.js";import{_ as F}from"./PrimaryButton-D_FwQD6O.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$={class:"flex items-center justify-end mt-4"},T={__name:"ForgotPassword",props:{status:String},setup(r){const e=d({email:""}),n=()=>{e.post(route("password.email"))};return(C,a)=>(m(),i(c,null,[s(t(f),{title:"Forgot Password"}),s(b,null,{logo:l(()=>[s(x)]),default:l(()=>[a[2]||(a[2]=o("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1)),r.status?(m(),i("div",N,p(r.status),1)):_("",!0),o("form",{onSubmit:y(n,["prevent"])},[o("div",null,[s(k,{for:"email",value:"Email"}),s(V,{id:"email",modelValue:t(e).email,"onUpdate:modelValue":a[0]||(a[0]=u=>t(e).email=u),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),s(v,{class:"mt-2",message:t(e).errors.email},null,8,["message"])]),o("div",$,[s(F,{class:w({"opacity-25":t(e).processing}),disabled:t(e).processing},{default:l(()=>a[1]||(a[1]=[g(" Email Password Reset Link ")])),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{T as default};