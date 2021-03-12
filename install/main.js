new Vue({
    el: "#app",
    data: {
        model: {
            host: "",
            user_name: "",
            password: "",
            database: "",
            admin_name: "",
            admin_user: "",
            admin_document: "",
            admin_password: ""
        },
        connection: true,
        spinners: false,
        form: true,
        error: ""
    },
    methods: {
        config(e) {
            e.preventDefault()
            error = this.model.host.length == 0 ? true : false;
            error = this.model.user_name.length == 0 ? true : false;
            error = this.model.database.length == 0 ? true : false;
            error = this.model.admin_name.length == 0 ? true : false;
            error = this.model.admin_user.length == 0 ? true : false;
            error = this.model.admin_document.length == 0 ? true : false;
            if (error) {
                this.connection = true
                this.error = "datos incompletos"
            } else {
                let url = 'import.php'
                console.log(this.model);
                this.spinners = true
                fetch(url, {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.model)
                }).then(response => response.json())
                    .then(result => {
                        if (result.status == 200) {
                            this.form = false
                        } else {
                            this.spinners = false
                        }
                        this.error = result.message
                    }).catch(response => {
                        this.spinners = false
                        this.connection = true
                        this.error = "Por favor verifica los campos de conexión a la base de datos"
                    })
            }

        }
    }
})