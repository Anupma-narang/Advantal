<!-- End Footer -->
<script type="text/javascript">
    $(document).ready(function() {
        var sfGaurdUser = new Array(
                //"div.content input[id=system_product_tld_price_filters_tld_id]",
                "div.content input[id=user_company_case_study_user]",
                "div.content input[id=user_product_case_study_user]",
                "div.content input[id=profesional_user]",
                "div.content input[id=user_company_case_study_request_user]",
                "div.content input[id=user_product_case_study_request_user]",
                "div.content input[id=profesional_ProfesionalLetter_user]",
                "div.content input[id=concurso_user]",
                "div.content input[id=contribucion_user]",
                "div.content input[id=alertas_user_related]"
                );
        //add/edit form input for sfGaurdUser
        $(sfGaurdUser.toString()).autocomplete("<?php echo url_for("sfAdminDash/usernameJsonList?id=id"); ?>");
        //filter form input for sfGaurdUser
        //$(sfGaurdUser.toString().replace(/div.content /g, "td ")).autocomplete("<?php echo url_for("sfguarduser/jsonList"); ?>");
    });
</script>