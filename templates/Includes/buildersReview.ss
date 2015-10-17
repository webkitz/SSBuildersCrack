<!--Testing Template Rendering please ignore!-->
<% loop $Reviews %>
    <ul>
        <li>$title</li>
        <li>$date</li>
        <li>$comment</li>
        <li>$jobNumber</li>
        <li>$href</li>
    </ul>

<% end_loop %>