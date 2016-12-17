        <main>
            <div class="msg">
                <?php if ($this->message_status): ?>
                <div class="alert alert-<?= $this->message_status; ?>" role="alert">
                    <b><?= $this->message; ?></b>
                </div>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <input class="form-control" id="question" type="text" name="question" placeholder="Ask your question">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="btn-ask">Send for review</button>
                </span>
            </div>
            <div class="q-list">
                <h3>Recently asked questions:</h3>
                <ul>
                    <?php $questionList = $this->getPageParameters()['questionList']; ?>
                    <?php foreach ($questionList as $question): ?>
                    <li id="question-<?= $question->id; ?>">
                        <div class="q-inquire">
                            <h5 class="q-header"><?= $question->text; ?></h5>
                            <p class="q-author"><?= $question->author; ?></p>
                        </div>
                        <div class="q-rating">
                            <span class="q-votes"><?= $question->rating; ?></span>
                            <?php $addRating = ! empty($_SESSION['question'][$question->id]['rated']) ? ' rated' : ''; ?>
                            <i class="fa fa-thumbs-o-up fa-2x <?= $addRating; ?>" onclick="rate(<?= $question->id; ?>)"></i>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn btn-default" onclick="more()">Load more</button>
            </div>
            <?php if ($this->getPageBody() === 'home'): ?>
            <script src="<?= URL . 'assets/js/ask.js'; ?>"></script>
            <script src="<?= URL . 'assets/js/rate.js'; ?>"></script>
            <script src="<?= URL . 'assets/js/more.js'; ?>"></script>
            <?php endif; ?>
        </main>
