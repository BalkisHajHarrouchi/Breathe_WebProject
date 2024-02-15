const productArea = document.getElementById('product-area');
const aside = document.querySelector('aside');

productArea.addEventListener('mouseenter', () => {
  aside.style.display = 'block';
});

productArea.addEventListener('mouseleave', () => {
  aside.style.display = 'none';
});
