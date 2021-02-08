<html>
<head>
	<title>Download Ming</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php

// Fetching file From same directory and return data as array
$file = file("song.txt");

?>
<script type="text/javascript">

class Download_mingi{

	js_array;
	lost_link = [];
	links_arr = [];
	alpha=0;
	constructor(){
    	this.js_array =<?php echo json_encode($file); ?>;
    	//console.log(this.js_array);
	}

	/**
	 * It should wait but it flows like time,
	 * never wait for anyone
	 */
	Waiter(){

		let end_game = new Promise( (x,y)=>{
			
			this.Looping2()
			x( 'resl' );
		});

		end_game.then( (b)=>{
			console.log('LL ',b);
			console.log('Links : '+ this.links_arr );
			console.log('Losts : '+ this.lost_link );
		} );		
	}// End Waiter

	/**
	 * Looping over function get_api_down()
	 * @return {[type]} [description]
	 */
	loopThrough() {
	  //var myVar = setInterval( this.get_api_down , 1000);
	  	for(let i = 0; i < this.js_array.length; ){
			/*var x = `<h3> ${js_array[i]} </h3>`;
		 	$("#got_res").().text(x);*/  
		 	//await this.sleep(2000);
		 	console.log('StartLoop'+i);

		 	let getter = this.get_api_down(this.js_array[i]);
		 	
		 	console.log( `EndLoop ${i} and L=link: ${getter}` );
		 	//await this.sleep(2000);
		 	//console.log('EndLoopSleep');

		 	//console.log('Pushed-> ',this.lost_link);

		 	i++;
		}
	}//End loopThrough

	/**
	 * This function will accept that param{Link} and call API and download available song 
	 * @param  {[type]} Link = watch v= *   
	 */
	async get_api_down(link) {

		let url = `https://www.yt2mp3s.me/api/button/mp3/${link}`;

		let request_Api = await fetch(url);
		request_Api = await request_Api.text();

		
		let render = new Promise( (resolve,reject)=>{
			var Doc = new DOMParser().parseFromString(request_Api, "text/html");
			resolve(Doc);
		}); 

		render.then( (doc)=>{
			//console.log(doc);
			let main_link = (doc.querySelector(".shadow-xl") == null ) ? '' : doc.querySelector(".shadow-xl").href;
			let error_text =( doc.querySelector("h3").textContent == '' ) ? '' : doc.querySelector("h3").textContent ;

			if( main_link !== '' && error_text == ''){
				console.log('Redirected: '+ main_link);
				window.open(main_link, "_blank");	
			}else{
				console.log(`${error_text} for ${link}`);
			}

		} );
	    console.log(`End ${link} `);
	}// End get_api_down

}// End Class Download_mingi

//Calling Obj and Run Randapa
let obj = new Download_mingi;
obj.looping();

</script>
</body>
</html>