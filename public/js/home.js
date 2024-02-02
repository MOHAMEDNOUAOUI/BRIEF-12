var up = document.querySelector('#up');
var down = document.querySelector('#down');
var filterbutton = document.querySelectorAll('.button-filter');
var container = document.querySelector('.page2');
var files = [];


filterbutton.forEach(function(btn) {
    btn.addEventListener('click', function() {
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                container.innerHTML = ''; 
                var responseData = JSON.parse(this.responseText);
                console.log(responseData);

                
                for (let i = 0; i < responseData.posts.length; i++) {
                    let post = responseData.posts[i];

                    let div = document.createElement('div');
                    div.classList.add('cart', 'col-md-10', 'd-flex');
                    div.innerHTML = `
                        <div class="left w-25"></div>
                        <div class="right w-75">
                            <h2>${post.Title}</h2>
                            <p>${post.destination.destination_name}</p>
                            <p>${post.Content}</p>
                        </div>
                    `;
                    container.appendChild(div);
                }
            }
        };

        if (btn.id === 'up') {
            xml.open("GET", '/ordernew');
            xml.send();
        }
        else{
            xml.open('GET','/notordernow');
            xml.send();
        }
    });
});


function destination(e) {
    var container = document.querySelector('.page2');
    let xml = new XMLHttpRequest();
  
      document.querySelectorAll('.destinationss').forEach(function(element) {
        element.classList.remove('active');
    });

    e.classList.add('active');

    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = ''; 
            
            var responseData = JSON.parse(this.responseText);
            console.log(responseData);

            if (responseData && Object.keys(responseData).length > 0) {
                for (let i = 0; i < responseData.posts.length; i++) {
                    let post = responseData.posts[i];
                    console.log(post);

                    let div = document.createElement('div');
                    div.classList.add('cart', 'col-md-10', 'd-flex');
                    div.innerHTML = `
                        <div class="left w-25"></div>
                        <div class="right w-75">
                            <h2>${post.Title}</h2>
                            <p>Destination : ${post.destination.destination_name}</p>
                            <p>${post.Content}</p>
                        </div>
                    `;
                    container.appendChild(div);
                }
            } else {
                let h1 = document.createElement('h1');
                h1.textContent = 'NONE';
                container.appendChild(h1);
            }
        }
    };

    xml.open('POST', '/filter_continent', true);

    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    xml.setRequestHeader('X-CSRF-Token', csrfToken);

    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send('continent=' + encodeURIComponent(e.textContent));
}




document.querySelectorAll('.drop-zone__input').forEach(inputElement => {
 const dropZoneELement = inputElement.closest('.drop-zone');


    dropZoneELement.addEventListener('click' , e=>{
        inputElement.click();
    })

    inputElement.addEventListener('change',(e)=>{
        let filename = e.target.files[0].name;
        let filetype = e.target.value.split('.').pop();
        console.log(filetype);
        fileshow(filename,filetype);
        files.push(e.target.files);
        Uploadfile(files);
    })

});


// function deletethis(e) {
//     var filediv = e.closest('.file');
//     var filename = filediv.querySelector('p').textContent;
//     filediv.remove();
//     files = files.filter(fileArray => fileArray[0].name !== filename);
//     console.log(files);
// }


var titleplaceholder = document.querySelector('.modal-title');

document.querySelector('#title').addEventListener('input' , function(e) {
    titleplaceholder.textContent = e.target.value;
    if(e.target.value == ''){
        titleplaceholder.textContent = "Recits Title";
    }
})




// document.querySelector('#save').addEventListener('click',function(){
//     var titletext = document.querySelector('#title').value;
//     var texttext = document.querySelector('#textarea').value;
//     var continent = document.querySelector('#continent').value;
    
//     if(titletext.length > 3 && texttext.length > 20 && continent != 0){
//         console.log(titletext);
//         console.log(texttext);
//         console.log(continent);

//         var xml = new XMLHttpRequest();

//         xml.onreadystatechange = function() {
//             if(this.status==200){
//                 console.log(this.responseText);
//             }
//         }
//         xml.open('POST', '/uploadrecits', true);
//         xml.setRequestHeader('Content-type', 'application/json');
//         xml.send(JSON.stringify({ title: titletext, content: texttext, continent: continent , files: files}));
//     }


// })


function submitForm() {
    var titletext = document.querySelector('#title').value;
    var texttext = document.querySelector('#textarea').value;
    var continent = document.querySelector('#continent').value;
    var fileInput = document.querySelector('#image');
    var filesContainer = document.getElementById('uploadedFiles');

    // Get the latest list of images from the container
    var images = [];
    var uploadedImages = filesContainer.querySelectorAll('.uploaded img');



    uploadedImages.forEach(function (img) {
        images.push(img.src);
    });
    console.log('Title: ', titletext);
    console.log('Content: ', texttext);
    console.log('Destination: ', continent);
    console.log('Images: ', images);

    // Now you can send the data to the server using AJAX or form submission
}


function Uploadfile(e) {
    console.log(e);
}

function deleteImage(button) {
    var imageElement = button.parentNode;
    imageElement.remove();
}

function fileSelected(input) {
    var files = input.files;
    var filesContainer = document.getElementById('uploadedFiles');

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = function (e) {
            var imageUrl = e.target.result;
            var imageElement = document.createElement('div');
            imageElement.classList.add('uploaded-image');

            imageElement.innerHTML = `
                <img src="${imageUrl}" style="width:8rem;height:8rem" alt="Uploaded Image">
                <button type="button" onclick="deleteImage(this)">Delete</button>
            `;

            // Append the image element to the container
            filesContainer.appendChild(imageElement);
        };

        reader.readAsDataURL(file);
    }
}




