<?php
$arUrlRewrite = array(
    array(
            "CONDITION"	=>	"#^/film/#",
            "RULE"	=>	"",
            "ID"	=>	"agliullin:film",
            "PATH"	=>	"/film/index.php",
    ),
    array(
            "CONDITION"	=>	"#^/seance/#",
            "RULE"	=>	"",
            "ID"	=>	"agliullin:seance",
            "PATH"	=>	"/seance/index.php",
    ),
    array(
            "CONDITION"	=>	"#^/admin/hall/#",
            "RULE"	=>	"",
            "ID"	=>	"agliullin:adm.hall",
            "PATH"	=>	"/admin/hall/index.php",
    ),
    array(
            "CONDITION"	=>	"#^/admin/seance/#",
            "RULE"	=>	"",
            "ID"	=>	"agliullin:adm.seance",
            "PATH"	=>	"/admin/seance/index.php",
    ),
);

?>