<p>
    <strong>Welcome To The AllianceCMS Community!!!</strong>
</p>

<dl>
    <dt>
        al·li·ance
    </dt>
    <dd>
        <p>
            Pronunciation: \ə-ˈlī-ən(t)s\<br />
            Function: noun<br />
            Date: 14th century<br />
        </p>
        <p>
            <strong>1 a</strong>: the state of being allied; the action of allying <strong>b</strong>: a bond or connection between families, states, parties, or individuals (a closer alliance between government and industry)<br />
            <strong>2</strong>: an association to further the common interests of the members; specifically : a confederation of nations by treaty<br />
            <strong>3</strong>: union by relationship in qualities : affinity<br />
            <strong>4</strong>: a treaty of alliance<br />
        <p>
    </dd>
</dl>

<p>
    <strong><span style="color: red;">There are one or more errors that will prevent you from installing AllianceCMS</span></strong>
</p>

<?php if (isset($missingZone)): ?>
    <p>
        <strong>Error: There is no Zone folder for this subdomain</strong>

    </p>
    <p>
        Please navigate to the '<strong>zones</strong>' folder and make a copy of the '<strong>default</strong>' folder and name it: <strong><?php echo $_SERVER['SERVER_NAME']; ?></strong>
    </p>
    <p>
        The final path should be:  <strong>/zones/<?php echo $_SERVER['SERVER_NAME']; ?></strong>
    </p>
<?php endif; ?>
