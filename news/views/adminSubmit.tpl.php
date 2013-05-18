<h1>WYMeditor integration example</h1>
<p><a href="http://www.wymeditor.org/">WYMeditor</a> is a web-based XHTML WYSIWYM editor.</p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<textarea class="wymeditor"></textarea>
<input type="hidden" name="test" value="1" />
<input type="submit" class="wymupdate" />
</form>