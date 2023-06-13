export default class ErrorClient extends Error {
    constructor(message, data) {
        super(message);
        this.data = data;
        this.name = "ErrorClient";
    }
}