document.addEventListener("DOMContentLoaded", function () {
    var btnAdd = document.getElementById("addWL");
    var btnCancelNew = document.querySelector('#newWLModal .btn-secondary');

    const name = document.getElementById('CategoryName');
    const description = document.getElementById('CategoryDescription');
    const userOwner = document.getElementById('userIdInput');


    btnAdd.addEventListener("click", function () {
        $('#newWLModal').modal('show');
    });

    btnCancelNew.addEventListener('click', function () {
        $('#newWLModal').modal('hide');
    });

    (function () {
        const formAddCategory = document.getElementById('addCategoryForm');
        formAddCategory.onsubmit = function (e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('name', name.value);
            formData.append('description', description.value);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../backend/controllers/addCategory.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        if (xhr.response) {
                            try {
                                let res = JSON.parse(xhr.response);
                                if (res.success !== true) {
                                    alert(res.msg);
                                } else {
                                    alert(res.msg);
                                    name.value = "";
                                    description.value = "";
                                    userOwner.textContent = "";
                                    $('#newWLModal').modal('hide');

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

            xhr.send(formData);
        }

    })();

  
});
var btnConfirmEdit = document.getElementById('editCategoryButton');
var btnCancelEdit = document.querySelector('#editWLModal .btn-secondary');

btnConfirmEdit.addEventListener('click', function () {
    const id = document.getElementById('editCategoryID').innerHTML;
    const name = document.getElementById('editCategoryName').value;
   
    const description = document.getElementById('editCategoryDescription').value;
    
    modifyCategory(id, name, description);
});
function confirmDelete(categoryName, categoryId, description) {
    if (confirm('¿Estás seguro de que quieres eliminar la categoría ' + categoryName + '?')) {
        var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/controllers/deleteCategory.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                if (xhr.response) {
                    try {
                        let res = JSON.parse(xhr.response);
                        console.log(xhr);
                        if (res.success !== true) {
                            alert(res.msg);
                        } else {
                            alert(res.msg);
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

    var data = 'id=' + encodeURIComponent(categoryId) + '&name=' + encodeURIComponent(categoryName) + '&description=' + encodeURIComponent(description);
    xhr.send(data);
    }
}


// Agregar un producto a una categoría
function addProductInCategory(idProduct, idCategory) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/controllers/addProductInCategory.php', true);
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
                            alert(res.msg);
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

    var data = 'idProduct=' + encodeURIComponent(idProduct) + '&idCategory=' + encodeURIComponent(idCategory);
    xhr.send(data);
}

// Modificar una categoría
function modifyCategory(id, name, description) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/controllers/modifyCategory.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                if (xhr.response) {
                    try {
                        let res = JSON.parse(xhr.response);
                        console.log(xhr);
                        if (res.success !== true) {
                            alert(res.msg);
                        } else {
                            alert(res.msg);
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

    var data = 'id=' + encodeURIComponent(id) + '&name=' + encodeURIComponent(name) + '&description=' + encodeURIComponent(description);
    xhr.send(data);
}

// Obtener todas las categorías
function getAllCategories() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/controllers/getAllCategories.php', true);
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
                            console.log(res.categories);
                            displayCategories(res.categories, "allCategories");
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

// Obtener productos por categoría
function getProductByCategory(idCategory) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/controllers/getProductByCategory.php', true);
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
                            // Handle the response as needed
                            console.log(res.products);
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

    var data = 'idCategory=' + encodeURIComponent(idCategory);
    xhr.send(data);
}

document.addEventListener("DOMContentLoaded", function () {
    getAllCategories();
});

function loadCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                displayCategories(response.categories, "allCategories"); // Pasar el id de la tabla como segundo argumento
            } else {
                console.error("Error al cargar las categorías");
            }
        }
    };

    xhr.open("GET", '../backend/controllers/getAllCategories.php', true);
    xhr.send();
}

function displayCategories(categories, parentTableId) {
    var table = document.getElementById(parentTableId);

    if (!table) {
        console.error("Table not found. Check the parentTableId.");
        return;
    }

    if (!categories || categories.length === 0) {
        console.error("No categories to display.");
        return;
    }

    categories.forEach(function (category) {
        var row = table.insertRow();
        var cellName = row.insertCell(0);
        var cellDescription = row.insertCell(1);
        var cellActions = row.insertCell(2);

        cellName.innerHTML = "<a href='#' id='" + category.category_id + "' class='category-name'>" + category.category_name + "</a>";
        cellDescription.innerHTML = "<span class='category-description'>" + category.category_description + "</span>";
        var editButton = createButton(function () {
            fillEditModal(category.category_id, category.category_name, category.category_description);
            $('#editWLModal').modal('show');
        });

        var deleteButton = createButton(function () {
            confirmDelete(category.category_name,category.category_id,category.category_description);
        });

        var editIcon = createIcon(["bx", "bxs-pencil", "icon-large"]);
        var deleteIcon = createIcon(["bx", "bxs-trash", "icon-large"]);

        editButton.appendChild(editIcon);
        deleteButton.appendChild(deleteIcon);

        cellActions.appendChild(editButton);
        cellActions.appendChild(deleteButton);
    });
}

// Llamada inicial
loadCategories();

function createButton(clickHandler) {
    var button = document.createElement("button");
    button.classList.add("bg-transparent", "border-0", "ms-3");
    button.addEventListener("click", clickHandler);
    return button;
}

function createIcon(classes) {
    var icon = document.createElement("i");

    classes.forEach(function (className) {
        icon.classList.add(className);
    });

    return icon;
}

function fillEditModal(categoryId, categoryName, categoryDescription) {
    console.log(categoryId, categoryName, categoryDescription);

    document.getElementById('editCategoryID').innerHTML = categoryId;
    document.getElementById('editCategoryName').value = categoryName;
    document.getElementById('editCategoryDescription').value = categoryDescription;

}