class Mola {
    static returnDatatable(value) {
        let data;
        if (value === null) {
            data = "-";
        } else {
            data = value;
        }

        return data;
    }

    static returnDate(value) {
        let data;
        if (value === null) {
            data = "-";
        } else {
            const date = new Date(value);
            data = date
                .toLocaleString("id-ID", {
                    day: "2-digit",
                    month: "2-digit",
                    year: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit",
                    timeZone: "Asia/Jakarta",
                })
                .replace(".", ":")
                .replace(".", ":")
                .replace(/\//g, "-")
                .replace(",", "");
        }

        return data;
    }
}
