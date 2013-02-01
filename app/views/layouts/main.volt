{# main.volt #}
<!DOCTYPE html>
<html>
<head>
    <title>{% block title %}{% endblock %}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css" />

    {% block head %}

    {% endblock %}

</head>
<body>
<div id="wrapper" class="container">
    <div id="header" class="masthead">
        {% block header %}
        {% endblock %}
    </div>
    <div id="content">
        {% block content %}
        {% endblock %}
    </div>
    <div id="footer">
        {% block footer %}
        {% endblock %}
    </div>
</div>

{{ javascript_include("js/jquery/jquery-1.8.3.min.js") }}
{{ javascript_include("js/bootstrap/bootstrap.min.js") }}


</body>
</html>