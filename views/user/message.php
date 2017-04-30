
<div class="content-container message-container">

    <div class="message-heading">
        <strong><?= $msg->message_title ?></strong>
    </div>

    <textarea readonly class="message-content" rows="8">
        <?= $msg->message_content ?>
    </textarea>

    <div class="message-footer">
        <div class="text-left"><p>Sent by <strong><?= $msg->message_author ?></strong></p></div>
        <div class="text-right"><p><strong><?= $msg->author_email ?></strong></p></div>
    </div>

</div>