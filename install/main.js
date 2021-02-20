new Vue({
    el: "#app",
    data: {
        model: {
            host: "",
            user_name: "",
            password: "",
            database: "",
        },
        spinners: false,
        form: true,
        error: ""
    },
    methods: {
        config(e) {
            e.preventDefault()
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
                        this.error = "Error en el servidor"
                    }
                }).catch(response => {
                    this.spinners = false
                    this.error = "Por favor llena todos los campos"
                })

        }
    }
}) 