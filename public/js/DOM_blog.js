//JSON array for blog post content --------------------------------------------------------
var blog = [
		    {
		        "title": "This is a title for this",
		        "date": "2015-10-30",
		        "author": "Isaac Castillo",
		        "image": "img/corgi1.jpg",
		        "tags": [
		            "Web Development",
		            "Design",
		            "Html"
		        ],
		        "category": "development",
		        "post": "lorem ipsum dolor and stuff here"
		    },
		    {
		        "title": "This is another title for this",
		        "date": "2015-02-28",
		        "author": "Isaac Castillo",
		        "image": "img/corgi2.jpg",
		        "tags": [
		            "Front-end",
		            "PHP",
		            "MySQL"
		        ],
		        "category": "graphic design",
		        "post": "dorac ipsum dolor and other stuff here"
		    },
		    {
		        "title": "This is another title for this",
		        "date": "2015-04-22",
		        "author": "Isaac Castillo",
		        "image": "img/corgi3.jpg",
		        "tags": [
		            "Back-end",
		            "JQuery",
		            "Laravel"
		        ],
		        "category": "graphic design",
		        "post": "dorac ipsum dolor and other stuff here"
		    },
		    {
		        "title": "This is a title for this",
		        "date": "2015-10-30",
		        "author": "Isaac Castillo",
		        "image": "img/corgi1.jpg",
		        "tags": [
		            "Web Development",
		            "Design",
		            "Html"
		        ],
		        "category": "development",
		        "post": "lorem ipsum dolor and stuff here"
		    },
		    {
		        "title": "This is another title for this",
		        "date": "2015-02-28",
		        "author": "Isaac Castillo",
		        "image": "img/corgi2.jpg",
		        "tags": [
		            "Front-end",
		            "PHP",
		            "MySQL"
		        ],
		        "category": "graphic design",
		        "post": "dorac ipsum dolor and other stuff here"
		    },
		    {
		        "title": "This is another title for this",
		        "date": "2015-02-28",
		        "author": "Isaac Castillo",
		        "image": "img/corgi3.jpg",
		        "tags": [
		            "Back-end",
		            "JQuery",
		            "Laravel"
		        ],
		        "category": "graphic design",
		        "post": "dorac ipsum dolor and other stuff here"
		    }
		];

//Start JavaScript-------------------------------------------------------------------

		var htmlString = '';
		for (i = 0; i < blog.length; i++){
			htmlString += '<div class="row col-md-12">\
						<div class ="col-md-10 titleRow">\
							<h1 id="blog-title">' + blog[i].title + '</h1>';
			htmlString += '<h4>Posted on: <span>' + blog[i].date + ' --\ ' 
							+ '</span>By: <span>' + blog[i].author + ' --\ ' 
							+ '</span>About: <span>' + blog[i].category + '</span></h4>';
			
					var tagString = "";
					for (k = 0; k < blog[i].tags.length; k++){
						if (k == blog[i].tags.length - 1){
							tagString += blog[i].tags[k]
						} else {
							tagString += blog[i].tags[k] + ", ";
						}
					}
			
			htmlString += '<h6>Tags: <span>' + tagString + '</span></h6>\
						</div>\
						</div>';
			htmlString += '<div class="row contentRow">\
							<div class="col-md-7">\
								<img src="' + blog[i].image + '">\
							</div>\
						<div class="col-md-5 postContent">';
			htmlString += '<p>' + blog[i].post + '</p></div>\
							</div>\
						</div>';
		}

		var post = document.getElementById('post');
		post.innerHTML = htmlString;

//The JavaScript loop above should be creating the HTML template below for each individual post from the JSON array object elements.

// <div class="row col-md-12">
// 		<div class ="col-md-11 titleRow">
// 			<h1 id="blog-title">Blog Post Title</h1>
// 			<h4>Posted on: <span class="date">Date -- </span>By: <span class="author">Author -- </span>About: <span class="category">Category</span></h4>
// 			<h6>Tags: <span class="tagElement">Web, Design, HTML</span></h6>  
// 		</div>
// 	</div>
// 	<div class="row contentRow">
// 		<div class="col-md-6">
// 			<img src="whatever">
// 		</div>
// 		<div class="col-md-6 postContent">
// 			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
// 			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
// 			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
// 			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
// 			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
// 		</div>
// 	</div>



////How to loop through an array object (without creating the HTML around it at the same time).
////This should loop through each element within the blog array and replace the innnerHTML within the post.
		// for (i = 0; i < blog.length; i++){
		// 	var postTitle = document.getElementsByTagName('h1');
		// 	console.log(postTitle[i]);
		// 	postTitle[i].innerHTML = blog[i].title;
			
		// 	var postDate = document.getElementsByClassName('date');
		// 	postDate[i].innerHTML = blog[i].date + " -- ";

		// 	var postAuthor = document.getElementsByClassName('author');
		// 	postAuthor[i].innerHTML = blog[i].author + " -- ";

		// 	var postCategory = document.getElementsByClassName('category');
		// 	postCategory[i].innerHTML = blog[i].category;

		// 	var postImage = document.getElementsByTagName('img');		
		// 	postImage[i].src = "'" + blog[i].image + "'"; 			////This was not working!!!

		// 	var post = document.getElementsByClassName('postContent');
		// 	post[i].innerHTML = blog[i].post;

		// //How to deal with looping through an array object within a larger array object's loop.
		// //This is supposed to look through each of the tag elements within each of the blog elements.
		// //It then assigns them to a concatinating string that will replace the innerHTML within the post.
		// 	var postTags = document.getElementsByClassName('tagElement');
		// 	var tagString = "";
		// 	for (k = 0; k < blog[i].tags.length; k++){
		// 		if (k == blog[i].tags.length - 1){
		// 			tagString +=blog[i].tags[k]
		// 		} else {
		// 			tagString += blog[i].tags[k] + ", ";
		// 		}
		// 		postTags[i].innerHTML = tagString; 
		// 	}
		// }


