        <main>
            <div class="ask-block">
                <form action="<?= URL . $this->getPageLanguage() . '/home/'; ?>" method="post">
                    <input type="text" name="question" placeholder="Ask your question">
                    <input type="submit" value="Send new question">
                </form>
            </div>
            <div class="q-list">
                <h4>Recently asked questions:</h4>
                <ul>
                <?php $question_list = $this->getPageParameters()['question_list']; ?>
                <?php foreach ($question_list as $question): ?>
                    <li>
                        <h5 class="q-header"><?= $question->question_text; ?></h5>
                        <p class="q-author"><?= $question->question_author; ?></p>
                    </li>
                <?php endforeach; ?>
                </ul>
                <button class="btn btn-load">Load more</button>
            </div>
        </main>
