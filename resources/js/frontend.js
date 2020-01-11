class inputMD{
	constructor(selector){
		this.input = document.querySelector(selector);
		this.bindEvents();
	}
	bindEvents(){
		console.log("INPUT: "+this.input)

		this.input.addEventListener("keyup",()=>{
			alert('qoasfas')
			if(this.input.value=="") return this.input.classList.remove('non-empty')
			this.input.classList.add('non-empty');
		})
	}
}
(function(){
	new inputMD(".input-form input");
})()