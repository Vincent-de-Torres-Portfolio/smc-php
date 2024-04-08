<h2>Applicant Information</h2>
<?php if ($applicantInfo): ?>
    <p><strong>Name:</strong> <?= htmlspecialchars($applicantInfo['name']) ?></p>
    <p><strong>Position:</strong> <?= htmlspecialchars($applicantInfo['position']) ?></p>
    <p><strong>Date of Interview:</strong> <?= htmlspecialchars($applicantInfo['date_of_interview']) ?></p>
    <p><strong>Ranking for Communication:</strong> <?= htmlspecialchars($applicantInfo['ranking_communication']) ?></p>
    <p><strong>Ranking for Computer Skills:</strong> <?= htmlspecialchars($applicantInfo['ranking_computer_skills']) ?></p>
    <p><strong>Ranking for Business Knowledge:</strong> <?= htmlspecialchars($applicantInfo['ranking_business_knowledge']) ?></p>
    <p><strong>Interviewer Comments:</strong> <?= htmlspecialchars($applicantInfo['interviewer_comments']) ?></p>
<?php else: ?>
    <p>No applicant information available.</p>
<?php endif; ?>