<script>
	export default{
		functional:true,
		
		render:function(createElement,context){
			var data = {
			...context.data,
			on:{
				beforeEnter:function(ele){
					ele.style.opacity=0;
					ele.style.transform="scale(0)";
					ele.style.transition="all .2s cubic-bezier(0.4,0.0,0.2,1)"
				},
				enter:function(ele)
				{
					const dalay = ele.dataset.index * 250;
					setTimeout(()=>{
						ele.style.opacity=1;
						ele.style.transform="scale(1)";
					}
						,dalay)
				},
				leave:function(ele){
					const dalay = ele.dataset.index * 250;
					setTimeout(()=>{
						ele.style.opacity=0;
						ele.style.transformation="scale(0)";
					}
						,dalay)
					}
				}
			}
			return createElement('transition-group',data,context.children);
		}
	}
</script>