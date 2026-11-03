const theme = document.getElementById("filter-theme");
const regime = document.getElementById("filter-regime");
const persNb = document.getElementById("filter-pers");
const prixMin = document.getElementById("filter-min");
const prixMax = document.getElementById("filter-max");

const menuList = document.getElementById("menus-list");

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

    menuList.replaceChildren()

    const menus = await reponse.json()

    if(menus.length === 0) 
    {
        const listeVide = document.createElement('p')
        listeVide.className = 'liste-vide'
        listeVide.textContent = 'Aucun menu ne correspond à votre recherche.'
        menuList.append(listeVide)
    }
    

    console.log(menus)

    //Boucle permettant de recréer les cartes des menus en fonction des éléments du filtre choisi- un createElement par ligne de la carte pour ne pas utiliser innerHTML
    for (const menu of menus ) {
        const newCol = document.createElement('div')
        newCol.className = 'col'
        menuList.append(newCol)
        const newCard = document.createElement('div')
        newCard.className = 'card h-100'
        newCol.append(newCard)
        const newCardInner = document.createElement('div')
        newCardInner.className = 'card-inner'
        newCard.append(newCardInner)
        const newCardImage = document.createElement('div')
        newCardImage.className = 'card-image'
        newCardInner.append(newCardImage)
        const newCardImg = document.createElement('img')
        newCardImg.className = 'card-img'
        newCardImg.src = '/images/' + menu.image
        newCardImg.alt = "Image du " + menu.nomMenu
        newCardImage.append(newCardImg)
        const newCardTitle = document.createElement('h3')
        newCardTitle.className = 'card-title'
        newCardTitle.textContent = menu.nomMenu
        newCardInner.append(newCardTitle)
        const newTheme = document.createElement('p')
        newTheme.className = 'card-theme'
        newTheme.textContent = menu.theme
        newCardInner.append(newTheme)
        const newDescription = document.createElement('p')
        newDescription.className = 'card-description'
        newDescription.textContent = menu.description
        newCardInner.append(newDescription)
        const newPrice = document.createElement('p')
        newPrice.className = 'card-price'
        newPrice.textContent = 'A partir de '+menu.prix.toFixed(2).replace('.',',')+' € / personne'//mise en forme des décimales
        newCardInner.append(newPrice)
        const newMin = document.createElement('p')
        newMin.className = 'card-min'
        newMin.textContent = 'Minimum '+menu.nbPersonneMin+' personnes'
        newCardInner.append(newMin)
        const newDetails = document.createElement('a')
        newDetails.className = 'detail'
        newDetails.href = '/?page=menu_details&id=' + menu.id
        newDetails.textContent = 'Voir le détail'
        newCardInner.append(newDetails)

    }
}

theme.addEventListener('change', changeFilter);
regime.addEventListener('change', changeFilter);
persNb.addEventListener('input', changeFilter);
prixMin.addEventListener('change', changeFilter);
prixMax.addEventListener('change', changeFilter);

