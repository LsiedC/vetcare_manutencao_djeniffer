<?php
require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/auth.php';exigirLogin();
$titulo='Consultas';$status=$_GET['status']??'';
$sql="SELECT c.*,a.nome AS animal FROM consultas c JOIN animais a ON a.id=c.animal_id";
// Chamado 4 - A listagem nao estava sendo aplicada
$param=[];
if (in_array($status,['Agendada','Realizada','Cancelada'],true)) { $sql.=' WHERE c.status=?'; $param[]=$status; } else { $status=''; } // Aqui ele valida o status, se for um dos 3, ele aplica o filtro
$sql.=' ORDER BY c.data_consulta DESC';
$stmt=$pdo->prepare($sql); $stmt->execute($param); $rows=$stmt->fetchAll(); 



include __DIR__.'/../includes/header.php';?>
<h1>Consultas</h1><p class="muted">Agenda e histórico de atendimentos.</p><div class="actions"><a class="btn" href="form.php">+ Nova consulta</a></div>
<section class="panel"><form method="get"><div class="field"><label>Filtrar por status</label><select name="status"><option value="">Todos</option><?php foreach(['Agendada','Realizada','Cancelada'] as $op):?><option value="<?=$op?>" <?=$status===$op?'selected':''?>><?=$op?></option><?php endforeach;?></select></div><button>Filtrar</button></form></section>
<div class="panel table-wrap"><table><tr><th>Animal</th><th>Data</th><th>Veterinário</th><th>Motivo</th><th>Status</th><th>Ações</th></tr>
<?php foreach($rows as $r): ?><tr><td><?= htmlspecialchars($r['animal']) ?></td><td><?= date('d/m/Y H:i',strtotime($r['data_consulta'])) ?></td><td><?= htmlspecialchars($r['veterinario']) ?></td><td><?= htmlspecialchars($r['motivo'] ?? '') ?></td><td><?= htmlspecialchars($r['status']) ?></td><td><a href="form.php?id=<?= (int)$r['id'] ?>">Editar</a> | 
  <!-- Chamado 8 — Era possível excluir uma consulta sem confirmação
Só adicionei uma confirmação em html pra quando ele clicar no botao de excluir ele manda um popup pro usuario confirmar se quer mesmo excluir ou nao --> 

<a href="excluir.php?id=<?= (int)$r['id'] ?>" onclick="return confirm('Tem certeza de que deseja excluir esta consulta? Esta ação não poderá ser desfeita.');">Excluir</a></td></tr><?php endforeach; if (!$rows): ?><tr><td colspan="6">Nenhuma consulta encontrada para esse filtro.</td></tr><?php endif; ?>
</table></div><?php include __DIR__.'/../includes/footer.php';?>
