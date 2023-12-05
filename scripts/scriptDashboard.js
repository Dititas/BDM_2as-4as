$(document).ready(function () {
    // Inicializar carruseles
    initCarousel("carouselLastProducts");
    initCarousel("carouselRecommended");
    initCarousel("carouselMostSelled");

    // Obtener productos después de cargar la página
    getAllProducts();
});

function initCarousel(carouselId) {
    var $carousel = $("#" + carouselId);
    $carousel.carousel({
        interval: false
    });

    var carouselWidth = $carousel.find(".carousel-inner")[0].scrollWidth;
    var cardWidth = $carousel.find(".carousel-item").width();
    var scrollPosition = 0;

    $carousel.find(".carousel-control-next").on("click", function () {
        if (scrollPosition < carouselWidth - cardWidth * 4) {
            scrollPosition += cardWidth;
        } else {
            scrollPosition = 0;
        }
        $carousel.find(".carousel-inner").animate(
            { scrollLeft: scrollPosition },
            600
        );
    });

    $carousel.find(".carousel-control-prev").on("click", function () {
        if (scrollPosition > 0) {
            scrollPosition -= cardWidth;
        } else {
            scrollPosition = carouselWidth - cardWidth * 4;
        }
        $carousel.find(".carousel-inner").animate(
            { scrollLeft: scrollPosition },
            600
        );
    });
}


function getAllProducts() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', './backend/controllers/getAllProducts.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = function () {
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				if (xhr.response) {
					try {
						let res = JSON.parse(xhr.response);

						if (res.success !== true) {
							alert(res.msg);
						} else {
							// Suponiendo que 'res.products' es el array de productos obtenido de la respuesta JSON
							if (res.success === true) {
								const carouselInner = document.querySelector('#carouselLastProducts .carousel-inner');

								// Limpiar el contenido actual del carousel
								carouselInner.innerHTML = '';

								// Iterar sobre los productos y agregar cada uno al carousel
								res.products.forEach((product, index) => {

									const carouselItem = document.createElement('div');
									carouselItem.classList.add('carousel-item');

									// Establecer la clase 'active' en el primer elemento
									if (index === 0) {
										carouselItem.classList.add('active');
									}

									const card = document.createElement('div');
									card.classList.add('card', 'bg-dark');

									// Agregar el id al card
									card.id = `${product.product_id}`;

									const imgWrapper = document.createElement('div');
									imgWrapper.classList.add('img-wrapper');

									const img = document.createElement('img');
									//img.src = `data:image/jpeg;base64,${product.product_imagen}`;  // Asignar la imagen en formato base64
									img.src = "https://th.bing.com/th/id/OIP.jWYetXQV3M8icma-9KKj-QHaEo?w=270&h=180&c=7&r=0&o=5&pid=1.7";
									img.alt = `Imagen del producto ${index + 1}`;
									img.classList.add('d-block', 'w-100');

									imgWrapper.appendChild(img);
									card.appendChild(imgWrapper);

									const cardBody = document.createElement('div');
									cardBody.classList.add('card-body');

									const title = document.createElement('h5');
									title.classList.add('card-title');
									title.textContent = product.product_name;

									const description = document.createElement('p');
									description.classList.add('card-text');
									description.textContent = product.product_description;

									cardBody.appendChild(title);
									cardBody.appendChild(description);
									card.appendChild(cardBody);

									carouselItem.appendChild(card);
									carouselInner.appendChild(carouselItem);
								});

							}

						}
					} catch (error) {
						console.error("Error parsing JSON: ", error);
					}
				} else {
					console.error("Server response is empty");
				}
			} else {
				console.error("Error in AJAX request: " + xhr.status);
			}
		}
	}

	xhr.send();
}
