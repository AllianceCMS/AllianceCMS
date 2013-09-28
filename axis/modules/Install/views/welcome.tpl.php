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
    We Will Now Walk You Through The Installation Process
</p>

<?php $formHelper->inputFormStart('/install/language'); ?>
    <p>
        <?php $formHelper->inputHidden('install', '1'); ?>
        <?php $formHelper->inputSubmit('submit', 'Start Installation', array('class' => 'button')); ?>
    </p>
<?php $formHelper->inputFormEnd(); ?>