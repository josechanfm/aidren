import{B as i,U as c,o as s,d as a,a as d,t as u,E as m,r as p,l as _}from"./app-6POxqXXZ.js";const f={class:"text-sm text-red-600"},k={__name:"InputError",props:{message:String},setup(e){return(o,t)=>i((s(),a("div",null,[d("p",f,u(e.message),1)],512)),[[c,e.message]])}},g={class:"block font-medium text-sm text-gray-700"},v={key:0},h={key:1},y={__name:"InputLabel",props:{value:String},setup(e){return(o,t)=>(s(),a("label",g,[e.value?(s(),a("span",v,u(e.value),1)):(s(),a("span",h,[m(o.$slots,"default")]))]))}},x=["value"],S={__name:"TextInput",props:{modelValue:String},emits:["update:modelValue"],setup(e,{expose:o}){const t=p(null);return _(()=>{t.value.hasAttribute("autofocus")&&t.value.focus()}),o({focus:()=>t.value.focus()}),(r,n)=>(s(),a("input",{ref_key:"input",ref:t,class:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm",value:e.modelValue,onInput:n[0]||(n[0]=l=>r.$emit("update:modelValue",l.target.value))},null,40,x))}};export{y as _,S as a,k as b};
