$(document).ready(async ()=>{

    let vm = new Vue({
        el: "#playlistVue",
        data: { array: [] },
        methods: {
            update: function (item) {
                this.array.splice(0);
                this.array = item;
                if (item == null) {
                    this.array = [];
                }
               
            }
        }
    });
    
});