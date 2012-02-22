<table class="table table-striped table-bordered table-condensed">
  <tr>
    <th>Cost Form Number</th>
    <td><?php echo $costForm->id ?></td>
  </tr>
  <tr>
    <th>Project</th>
    <td><?php echo $costForm->Projects ?></td>
  </tr>
  <tr>
    <th>Received Advance</th>
    <td>
      <?php if ($costForm->advanceRecieved): ?>
        <?php echo $costForm->advanceRecieved." ".$costForm->Currencies; ?>
      <?php else: ?>
        -
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <th>Status</th>
    <td><?php echo $costFormStatus[$costForm->totalStatus] ?></td>
  </tr>
</table>
