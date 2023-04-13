export default class {
    constructor(opts) {
        this.id = opts.ID
        this.title = opts.TITLE
        this.parent_tasks = opts.PARENT_ID
        this.tags = opts.TAGS | []
        this.resp = opts.RESPONSIBLE_ID
        this.create_date = opts.CREATE_DATE
        this.logs = this.Logs(opts.LOGS)
        this.time_spent = opts.TIME_SPENT_IN_LOGS
    }
}
