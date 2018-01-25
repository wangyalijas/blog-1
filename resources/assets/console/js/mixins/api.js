export default {
    methods: {
        simpleAPIRequestErrorHandler(error) {
            let message;
            try {
                message = error.response.data.message;
            } catch (error) {
                message = '';
            }

            this.$message.error(`Server Error. ${message}`);
        }
    }
}