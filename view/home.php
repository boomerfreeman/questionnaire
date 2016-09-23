        <main>
            <div class="msg">
                <?php if ($this->message_status): ?>
                <div class="alert alert-<?= $this->message_status; ?>" role="alert">
                    <b><?= $this->message; ?></b>
                </div>
                <?php endif; ?>
            </div>
            <div class="review-form">
                <form class="form-inline input-group" action="<?= URL . $this->getPageLanguage() . '/home/'; ?>" method="post">
                    <input class="form-control" type="text" name="question" placeholder="Ask your question">
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="Send for review">
                    </span>
                </form>
            </div>
            <div class="q-list">
                <h3>Recently asked questions:</h3>
                <ul>
                    <?php $question_list = $this->getPageParameters()['question_list']; ?>
                    <?php foreach ($question_list as $question): ?>
                    <li>
                        <div class="q-inquire">
                            <h5 class="q-header"><?= $question->question_text; ?></h5>
                            <p class="q-author"><?= $question->question_author; ?></p>
                        </div>
                        <div class="q-rating">
                            <i class="fa fa-thumbs-o-up fa-2x"></i>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn btn-default" onclick="getMore()">Load more</button>
            </div>
            <?php if ($this->getPageBody() === 'home'): ?>
            <script src="<?= URL . 'assets/js/more.js'; ?>"></script>
            <?php endif; ?>
        </main>
