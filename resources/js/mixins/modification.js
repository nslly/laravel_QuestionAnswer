export default {
    data() {
        return {
            editing: false,
        }
    },

    computed: {
        canAccept() {
            return this.authorize('modify', this.model);
        },
    },

    methods: {
        edit() {
            this.setEditCache();
            this.editing = true;
        },

        cancel() {
            this.restoreFromCache();
            this.editing = false;
        },

        update() {
            axios.put(this.endPoint, this.payload())
            .then(res => {
                this.bodyHtml = res.data.body_html;
                alert(res.data.message);
                this.editing = false;
            })
            .catch(err => {
                console.log("There something error", err);
            })
        },

        destroy() {

            if(confirm("Are you sure you want to delete?")) {
                this.delete();
            }
        }
    }
}