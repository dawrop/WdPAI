const search = document.querySelector('input[placeholder="Search..."]');
const bookContainer = document.querySelector(".content");


search.addEventListener("keyup", function (event) {
   if (event.key === "Enter") {
      event.preventDefault();

      const data = {search: this.value};

      fetch("/search", {
         method: "POST",
         headers: {
            'Content-Type': 'application/json'
         },
         body: JSON.stringify(data)
      }).then(function (response) {
         return response.json();
      }).then(function (books) {
         bookContainer.innerHTML = "";
         loadBooks(books)
      });
   }
});

function loadBooks(books) {
   books.forEach(book => {
      console.log(book);
      createBook(book);
   });
}

function createBook(book) {
   const template = document.querySelector("#bookTemplate");
   const clone = template.content.firstElementChild.cloneNode(true);


   const divDimmness = clone.querySelector(".dimness");
   divDimmness.id = `bookInfo${book.id}`;
   divDimmness.addEventListener('click', ()=>{
      hideBook(`bookInfo${book.id}`);
   });

   const imageList = clone.querySelectorAll("img");
   for(let image of imageList)
      image.src = `public/img/uploads/${book.image}`;

   const title = clone.querySelector(".bookContentTitle");
   title.innerHTML = book.title;
   const description = clone.querySelector(".bookContentDesc");
   description.innerHTML = book.description;
   const genre = clone.querySelector(".bookContentGenre");
   genre.innerHTML = book.genre;
   const author = clone.querySelector(".bookContentAuthor");
   author.innerHTML = book.author;

   const bookDiv = clone.querySelector(".book");
   bookDiv.addEventListener('click', ()=>{
      showBook(`bookInfo${book.id}`);
   });

   bookContainer.appendChild(clone);
}





