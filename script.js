// nav 
let navbar=document.getElementsByClassName("nav_l")[0];
let navlist=document.getElementsByClassName("navList")[0];
navbar.addEventListener("click",e=>{
    navlist.classList.add("active");
});
setInterval(e=>{
    navlist.classList.remove("active");
},5000);

// photo swap 
let arraOfPhotos=["switch1.jpg","switch2.jpg","switch3.jpg","switch4.jpg","switch5.jpg","switch6.jpg"];
let btnLeft=document.getElementsByClassName("left")[0];
let btnRight=document.getElementsByClassName("right")[0];
let Mainimg=document.getElementsByClassName("kolchi-img")[0];
let current=1;

btnLeft.addEventListener("click",e=>{
    if(current==1){
        current=arraOfPhotos.length;
    }
    Mainimg.src=`imgs/shift_imgs/switch${current}.jpg`;
    current--;
})
btnRight.addEventListener("click",e=>{
    if(current==arraOfPhotos.length){
        current=1;
    }
    Mainimg.src=`imgs/shift_imgs/switch${current}.jpg`;
    current++;
})
