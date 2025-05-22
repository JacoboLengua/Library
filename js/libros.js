$(document).ready(function() {
  const categories = [
    {name: 'Romance', titleClass: 'text-danger', btnClass: 'btn-danger'},
    {name: 'Action', titleClass: 'text-primary', btnClass: 'btn-primary'},
    {name: 'Suspense', titleClass: 'text-warning', btnClass: 'btn-warning'},
    {name: 'Terror', titleClass: 'text-dark', btnClass: 'btn-dark'},
    {name: 'Daily Life', titleClass: 'text-success', btnClass: 'btn-success'},
    {name: 'Religion', titleClass: 'text-info', btnClass: 'btn-info'},
    {name: 'Learning', titleClass: 'text-secondary', btnClass: 'btn-secondary'}
  ];

  const $container = $('#book-sections');

  categories.forEach(function(category) {
    $.ajax({
      url: '../backend/books.php',
      method: 'GET',
      data: { category: category.name },
      dataType: 'json',
      success: function(books) {
        let sectionHtml = `
          <section>
            <h2 class="section-title ${category.titleClass} mt-5">${category.name}</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4"></div>
          </section>
        `;
        const $section = $(sectionHtml);
        const $row = $section.find('div.row');

        if (books.length === 0) {
          $row.append('<p class="text-muted">No hay libros disponibles en esta categoría.</p>');
        } else {
          books.forEach(function(book) {
            const cardHtml = `
              <div class="col">
                <div class="card h-100">
                  <img src="/LibraryManagement/assets/${book.cover_url}"class="card-img-top" alt="Portada ${book.title}">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title">${book.title}</h5>
                    <p class="card-text">${book.description}</p>
                    <p class="text-muted mb-3">Autor: ${book.author}</p>
                    <button class="btn ${category.btnClass} mt-auto read-btn" data-id="${book.id}">Read</button>
                  </div>
                </div>
              </div>
            `;
            $row.append(cardHtml);
          });
        }
        $container.append($section);
      },
      error: function() {
        console.error('Error al obtener los libros de la categoría: ' + category.name);
      }
    });
  });

  //Botón "Leer"
  $container.on('click', '.read-btn', function() {
    const id = $(this).data('id');
    window.location.href = `leer_libro.php?id=${id}`;
  });
});
