<?php function drawCreateTicketButton()
{ ?>
  <section class="ticket-section">
    <div class="section-header">
      <a href="../pages/create_ticket.php" class="btn">Create Ticket</a>
    </div>
    </div>
  <?php } ?>

  <?php function drawTickets(array $tickets)
  { ?>
    <section class="ticket-section">
      <div class="section-header">
        <h2>Submitted Tickets</h2>
      </div>
      <div class="ticket-cards">
        <?php foreach ($tickets as $ticket) { ?>
          <div class="ticket-card" id="card-<?= $ticket->id ?>">
            <a href="../pages/ticket.php?id=<?= $ticket->id ?>" class="card-link"></a>
            <div class="ticket-subject"><?= $ticket->subject ?></div>
            <div class="ticket-details">
              <p class="ticket-department">#<?= $ticket->dept_name ?></p>
              <p class="ticket-description"><?= $ticket->description ?></p>
              <p class="ticket-status"><?= $ticket->status ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
  <?php } ?>

  <?php function drawAssignedTickets(array $tickets)
  { ?>
    <section class="ticket-section">
      <div class="section-header">
        <h2>Assigned Tickets</h2>
      </div>
      <div class="ticket-cards">
        <?php foreach ($tickets as $ticket) { ?>
          <div class="ticket-card" id="card-<?= $ticket->id ?>">
            <a href="../pages/ticket.php?id=<?= $ticket->id ?>" class="card-link"></a>
            <div class="ticket-subject"><?= $ticket->subject ?></div>
            <div class="ticket-details">
              <p class="ticket-department">#<?= $ticket->dept_name ?></p>
              <p class="ticket-description"><?= $ticket->description ?></p>
              <p class="ticket-status"><?= $ticket->status ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
  <?php } ?>

  <?php
  $offset = 0;
  $limit = 10;
  ?>

  <?php function drawTicketsDepartment(array $tickets, array $departments, $offset, $limit, $selectedDepartment) 
  {
    global $offset, $limit;
  ?>
    <section class="ticket-section">
      <div class="section-header">
        <h2>Search for Department</h2>
      </div>
      <form method="GET">
        <select id="dept_id" name="dept_id" required>
          <option value="">Select a Department</option>
          <?php foreach ($departments as $department) : ?>
            <option value="<?php echo $department->dept_id; ?>"><?php echo $department->name; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit">Search</button>
      </form>
      <div class="ticket-cards">
        <?php foreach ($tickets as $ticket) { ?>
          <div class="ticket-card" id="card-<?= $ticket->id ?>">
            <a href="../pages/ticket.php?id=<?= $ticket->id ?>" class="card-link"></a>
            <div class="ticket-subject"><?= $ticket->subject ?></div>
            <div class="ticket-details">
              <p class="ticket-department">#<?= $ticket->dept_name ?></p>
              <p class="ticket-description"><?= $ticket->description ?></p>
              <p class="ticket-status"><?= $ticket->status ?></p>
            </div>
          </div>
        <?php } ?>
        <?php
    if (count($tickets) >= $limit) {
    ?>
    <button type="submit">Load More...</button>
    <?php } ?>
      </div>
    </section>
  <?php } ?>

  <?php function drawCreateTicket(array $departments)
  { ?>
    <section class="ticket-section">
      <div class="section-header">
        <h2>Create Ticket</h2>
      </div>
      <form class="create_ticket" action="../actions/action_submit_ticket.php" method="POST">

        <label for="subject">Department:</label>
        <select id="dept_id" name="dept_id" required>
          <option value="">Select a Department</option>
          <?php foreach ($departments as $department) : ?>
            <option value="<?php echo $department->dept_id; ?>"><?php echo $department->name; ?></option>
          <?php endforeach; ?>
        </select>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <input type="submit" value="Submit">
      </form>
    </section>
  <?php } ?>

  <?php function drawTicketPage(Ticket $ticket, array $comments)
  { ?>
    <section id="ticket-details">
      <h2>Ticket Details</h2>
      <div id="ticket-info">
        <span id="ticket-subject"><?= $ticket->subject; ?></span>
        <br>
        <span id="ticket-department">#<?= $ticket->dept_name; ?></span>
        <span id="ticket-status"><?= $ticket->status; ?></span>
        <br>
        <span id="ticket-description"><?= $ticket->description; ?></span>
        <br>
      </div>
    </section>

    <section id="ticket-comment">
      <h2>Comments</h2>
      <ul id="comment-list">
        <?php foreach ($comments as $comment) { ?>
          <li class="comment-item">
            <span class="comment-username"><?= $comment->username; ?></span>
            <span class="comment-role"><?= $comment->role; ?></span>
            <span class="comment-text"><?= $comment->text; ?></span>
          </li>
        <?php } ?>
      </ul>
      <form id="comment-form" method="post" action="../actions/action_submit_comment.php">
        <input id="ticket_id" type="hidden" name="ticket_id" value="<?= $_GET['id'] ?>" required="required">
        <textarea name="text" id="text" rows="4" placeholder="Enter your comment..." required></textarea>
        <button type="submit">Submit</button>
      </form>
    </section>

  <?php } ?>

  <?php function drawAssign(array $agents)
  { ?>
    <section class="ticket-section">
      <form class="create_ticket" action="../actions/action_assign.php" method="POST">

        <input id="ticket_id" type="hidden" name="ticket_id" value="<?= $_GET['id'] ?>" required="required">

        <label for="subject">Assign this Ticket:</label>
        <select id="user_id" name="user_id" required>
          <option value="">Select a Agent</option>
          <?php foreach ($agents as $agent) : ?>
            <option value="<?php echo $agent->id; ?>"><?php echo $agent->name; ?></option>
          <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit">
      </form>
    </section>
  <?php } ?>
