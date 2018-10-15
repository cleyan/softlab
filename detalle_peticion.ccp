<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False" PathID="detalle_peticion">
	<Components>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" connection="Datos" name="peticiones_estados_estado" dataSource="peticiones, estados, estados_pagos, medicos, pacientes, previsiones, procedencias, usuarios" wizardCaption="Lista de Peticiones, Estados, Estados Pagos, Medicos, Pacientes, Previsiones, Procedencias, Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="detalle_peticionpeticiones_estados_estado">
			<Components>
				<Label id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="47" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="hora" fieldSource="hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="H:nn" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="43" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_nacimiento" fieldSource="fecha_nacimiento" wizardCaption="Fecha Nacimiento" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="edad" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_medico" fieldSource="nom_medico" wizardCaption="Nom Medico" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado_pago" fieldSource="nom_estado_pago" wizardCaption="Nom Estado Pago" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="img_aviso" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="pacientes_fono" fieldSource="pacientes_fono" wizardCaption="Pacientes Fono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="celular" fieldSource="celular" wizardCaption="Celular" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="valor" wizardTheme="Inline" wizardThemeType="File" format="$0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="pacientes_email" fieldSource="pacientes_email" wizardCaption="Pacientes Email" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="saldo" wizardTheme="Inline" wizardThemeType="File" format="$0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="observaciones" fieldSource="observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="62"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="peticiones.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="Or" defaultValue="0" parameterSource="peticion_id" orderNumber="1"/>
				<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="peticiones.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" orderNumber="2" parameterSource="s_peticion_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="peticiones" posWidth="138" posHeight="298" posLeft="10" posTop="10"/>
				<JoinTable id="8" tableName="estados" posWidth="100" posHeight="100" posLeft="341" posTop="275"/>
				<JoinTable id="10" tableName="estados_pagos" posWidth="100" posHeight="100" posLeft="208" posTop="321"/>
				<JoinTable id="12" tableName="medicos" posWidth="100" posHeight="100" posLeft="474" posTop="222"/>
				<JoinTable id="14" tableName="pacientes" posWidth="133" posHeight="363" posLeft="797" posTop="6"/>
				<JoinTable id="23" tableName="previsiones" posWidth="100" posHeight="100" posLeft="661" posTop="171"/>
				<JoinTable id="25" tableName="procedencias" posWidth="100" posHeight="100" posLeft="492" posTop="80"/>
				<JoinTable id="27" tableName="usuarios" posWidth="100" posHeight="100" posLeft="169" posTop="435"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="29" fieldLeft="peticiones.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones" tableRight="estados" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="30" fieldLeft="peticiones.estado_pago_id" fieldRight="estados_pagos.estado_pago_id" tableLeft="peticiones" tableRight="estados_pagos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="31" fieldLeft="peticiones.medico_id" fieldRight="medicos.medico_id" tableLeft="peticiones" tableRight="medicos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="32" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="33" fieldLeft="peticiones.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="peticiones" tableRight="previsiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="34" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="35" fieldLeft="peticiones.usuario_id" fieldRight="usuarios.usuario_id" tableLeft="peticiones" tableRight="usuarios" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="7" tableName="peticiones" fieldName="peticiones.*"/>
				<Field id="9" tableName="estados" fieldName="nom_estado"/>
				<Field id="11" tableName="estados_pagos" fieldName="nom_estado_pago"/>
				<Field id="13" tableName="medicos" fieldName="nom_medico"/>
				<Field id="15" tableName="pacientes" fieldName="rut"/>
				<Field id="16" tableName="pacientes" fieldName="ficha"/>
				<Field id="17" tableName="pacientes" fieldName="nombres"/>
				<Field id="18" tableName="pacientes" fieldName="apellidos"/>
				<Field id="19" tableName="pacientes" fieldName="fecha_nacimiento"/>
				<Field id="20" tableName="pacientes" alias="pacientes_fono" fieldName="pacientes.fono"/>
				<Field id="21" tableName="pacientes" fieldName="celular"/>
				<Field id="22" tableName="pacientes" alias="pacientes_email" fieldName="pacientes.email"/>
				<Field id="24" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="26" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="28" tableName="usuarios" fieldName="nom_usuario"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="detalle_peticion.php" comment="//" forShow="True" url="detalle_peticion.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="detalle_peticion_events.php" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
