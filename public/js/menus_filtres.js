const theme = document.getElementById("filter-theme");
const regime = document.getElementById("filter-regime");
const persNb = document.getElementById("filter-pers");
const prixMin = document.getElementById("filter-min");
const prixMax = document.getElementById("filter-max");

async function changeFilter ()
{
    const params = new URLSearchParams({
        page: 'menus_filtre',
        theme: theme.value,
        regime: regime.value,
        persNb: persNb.value,
        priceMin: prixMin.value,
        priceMax: prixMax.value
        
    })
    
    const reponse = await fetch('/?'+ params)

    const menus = await reponse.json()

    console.log(menus)
}

theme.addEventListener('change', changeFilter);
regime.addEventListener('change', changeFilter);
persNb.addEventListener('change', changeFilter);
prixMin.addEventListener('change', changeFilter);
prixMax.addEventListener('change', changeFilter);

