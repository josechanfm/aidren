import{T as m,r as d,d as u,b as a,u as e,w as t,F as p,o as f,Z as c,a as r,n as _,f as w,y as b}from"./app-6POxqXXZ.js";import{A as g}from"./AuthenticationCard-D5toIc6-.js";import{_ as x}from"./AuthenticationCardLogo-BSyB0E75.js";import{_ as y,a as v,b as V}from"./TextInput-CbJvBjjw.js";import{_ as C}from"./PrimaryButton-DpEMmPPq.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const $={class:"flex justify-end mt-4"},I={__name:"ConfirmPassword",setup(k){const s=m({password:""}),n=d(null),i=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),n.value.focus()}})};return(A,o)=>(f(),u(p,null,[a(e(c),{title:"Secure Area"}),a(g,null,{logo:t(()=>[a(x)]),default:t(()=>[o[2]||(o[2]=r("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1)),r("form",{onSubmit:b(i,["prevent"])},[r("div",null,[a(y,{for:"password",value:"Password"}),a(v,{id:"password",ref_key:"passwordInput",ref:n,modelValue:e(s).password,"onUpdate:modelValue":o[0]||(o[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(V,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),r("div",$,[a(C,{class:_(["ms-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:t(()=>o[1]||(o[1]=[w(" Confirm ")])),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{I as default};
