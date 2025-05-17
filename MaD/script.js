// profile
const menuProfile = document.getElementsByClassName('profile_i')[0];
const menuContent = document.getElementsByClassName('profile')[0];
const logout=document.getElementsByClassName('LogOut')[0];

menuProfile.addEventListener('click', (event) => {
  event.stopPropagation(); // Prevent click from bubbling to the body
  menuContent.classList.toggle('off');
});

document.addEventListener('click', () => {
  menuContent.classList.add('off'); // Hide menu when clicking outside
});
//menu 
const menubtn = document.getElementsByClassName('bars')[0];
const menuContent2 = document.getElementsByClassName('menu')[0];
menubtn.addEventListener('click', (event) => {
    event.stopPropagation(); // Prevent click from bubbling to the body
    menuContent2.classList.toggle('hidden');
  });
  
  document.addEventListener('click', () => {
    menuContent2.classList.add('hidden'); // Hide menu when clicking outside
  });
