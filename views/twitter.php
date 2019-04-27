{% extends "layouts/base.html" %}

{% block content %}

<div class="card ">
  <form action="/search" method="post">
    <div class="card-header" id="toolbar">
      {{ include('tweetSearch.html') }}
    </div>
  </form>
  <divs class="card-body" id="display">
    {{ include('tweetDisplay.html') }}
  </div>
</div>
{% endblock content %}
