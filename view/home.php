        <main>
            <div class="ask-block">
                <h1>Ask anything you want:</h1>
                <form action="<?= URL . $this->getPageLanguage() . '/home/' ?>" method="post">
                    <input type="text" name="question" placeholder="Ask your question">
                    <input type="submit" value="Send new question">
                </form>
            </div>
            <div class="question-block">
                <h2>Question list</h2>
                <ul>
                <?php $question_list = $this->getPageParameters()['question_list']; ?>
                <?php foreach ($question_list as $question): ?>
                    <li><?= $question->question_text; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </main>
