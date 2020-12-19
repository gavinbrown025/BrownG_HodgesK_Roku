(() => {

    let vue_vm = new Vue({

        data: {

        },

        mounted: function () {
            
            // fetchData("./includes/index.php")
            //     .then(data => {
            //         data.forEach(project => {
            //             this.projects.push(project);
            //         });
            //     })
            //     .catch(err => console.error(err));

        },

        updated: function () {},

        methods: {
            submitLogin(){
                console.log('submit login');
            },

            showSignUp() {
                console.log('show sign up');
            }
        },

        components: {}

    }).$mount("#app");

})();