<style>
    /* Add some basic styles to make it look better */
    .multiselect {
        width: 200px;
        display: inline-block;
        position: relative;
    }

    .select-box {
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .options-container {
        display: none;
        position: absolute;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        z-index: 1;
    }

    .option {
        padding: 5px;
        cursor: pointer;
    }

    .option:hover {
        background-color: #f2f2f2;
    }
</style>
